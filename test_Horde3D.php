<?php

include("include/SDL.php");

SDL::SDL();

include("include/Horde3D.php");

Horde3D::Horde3D();

use Horde3D as H3D;

include("include/Horde3DUtils.php");

use Horde3DUtils as H3Dut;

// --------------------------------------------------------------------------

if ( SDL::Init( SDL::INIT_VIDEO ) != 0 )
{
	echo "SDL::Init Error : ".SDL::GetError().PHP_EOL;
	return false;
}

SDL::GL_SetAttribute( SDL::GL_RED_SIZE   ,  8 );
SDL::GL_SetAttribute( SDL::GL_GREEN_SIZE ,  8 );
SDL::GL_SetAttribute( SDL::GL_BLUE_SIZE  ,  8 );
SDL::GL_SetAttribute( SDL::GL_ALPHA_SIZE ,  8 );
SDL::GL_SetAttribute( SDL::GL_DEPTH_SIZE , 16 );
SDL::GL_SetAttribute( SDL::GL_MULTISAMPLESAMPLES , 0 );
SDL::GL_SetAttribute( SDL::GL_DOUBLEBUFFER, 1 );

$win_W = 640;
$win_H = 480;

$win = SDL::CreateWindow( "TEST", SDL::WINDOWPOS_CENTERED, SDL::WINDOWPOS_CENTERED, $win_W, $win_H, SDL::WINDOW_OPENGL | SDL::WINDOW_SHOWN );

if ( ! isset( $win ) )
{
	echo "SDL::CreateWindow Error : ".SDL::GetError().PHP_EOL;

	SDL::Quit();
	return false;
}

$ctx = SDL::GL_CreateContext( $win );

if ( ! isset( $ctx ) )
{
	echo "SDL::GL_CreateContext Error :".SDL::GetError().PHP_EOL;
	SDL::DestroyWindow( $win );
	SDL::Quit();

	return false;
}

if ( SDL::GL_SetSwapInterval( 1 ) < 0 )
{
	echo "Warning: Unable to set VSync! SDL Error: ".SDL::GetError().PHP_EOL;
}

// --------------------------------------------------------------------------

$mode = H3DRenderDevice::OpenGL4 ;

if ( ! H3D::Init( $mode ) )
{
	echo "H3D::Init Error : unable to init engine".PHP_EOL;
}

$pipeRes  = H3D::AddResource( H3DResTypes::Pipeline   , "pipelines/forward.pipeline.xml" , 0 );
$modelRes = H3D::AddResource( H3DResTypes::SceneGraph , "models/man/man.scene.xml" , 0 );
$animRes  = H3D::AddResource( H3DResTypes::Animation  , "animations/man.anim" , 0 );

H3Dut::LoadResourcesFromDisk( "data" );

$model = H3D::AddNodes( H3D::RootNode , $modelRes );

H3D::SetupModelAnimStage( $model , 0 , $animRes , 0 , "" , false );

$light = H3D::AddLightNode( H3D::RootNode , "Light1" , 0 , "LIGHTING" , "SHADOWMAP" );

H3D::SetNodeTransform( $light, 0, 20, 0, 0, 0, 0, 1, 1, 1, );
H3D::SetNodeParamF( $light, H3DLight::RadiusF, 0, 50.0 );

$cam = H3D::AddCameraNode( H3D::RootNode, "Camera" , $pipeRes );

H3D::SetNodeParamI( $cam, H3DCamera::ViewportXI, 0 );
H3D::SetNodeParamI( $cam, H3DCamera::ViewportYI, 0 );
H3D::SetNodeParamI( $cam, H3DCamera::ViewportWidthI , $win_W );
H3D::SetNodeParamI( $cam, H3DCamera::ViewportHeightI, $win_H );

H3D::SetupCameraView( $cam, 45.0, $win_W / $win_H, 0.5, 2048.0 );

H3D::ResizePipelineBuffers( $pipeRes, $win_W, $win_H );


// --------------------------------------------------------------------------

$t = 0.0;

for($i=0; $i<100; $i++)
{
	$t = $t + 0.1 ;

	H3D::SetModelAnimParams( $model, 0, $t, 1.0 );
	H3D::UpdateModel( $model , H3DModelUpdateFlags::Animation | H3DModelUpdateFlags::Geometry );

	H3D::SetModeTransform( $model,
		$t * 10, 0, 0, // translation
		0,0,0, // rotation
		1,1,1  // scale
	);

	H3D::Render( $cam );

	H3D::FinalizeFrame();
	SDL::GL_SwapWindow( $win );
}

Sleep(5);

// --------------------------------------------------------------------------

H3D::Release();

// --------------------------------------------------------------------------

SDL::DestroyWindow( $win );
SDL::Quit();
