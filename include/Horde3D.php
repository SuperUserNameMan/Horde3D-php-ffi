<?php

Horde3D::Horde3D(); // autoinit

//----------------------------------------------------------------------------------
// Enumerators Definition
//----------------------------------------------------------------------------------

/* Group: Enumerations */
class H3DRenderDevice
{
	/* Enum: H3DRenderDevice
	The available engine Renderer backends.

	OpenGL2				- use OpenGL 2 as renderer backend (can be used to force OpenGL 2 when higher version is undesirable)
	OpenGL4				- use OpenGL 4 as renderer backend (falls back to OpenGL 2 in case of error)
	OpenGLES3			- use OpenGL ES 3 as renderer backend
	*/
	const OpenGL2   = 2 ;
	const OpenGL4   = 4 ;
	const OpenGLES3 = 8 ;
};



class H3DOptions
{
	/* Enum: H3DOptions
			The available engine option parameters.

		MaxLogLevel         - Defines the maximum log level; only messages which are smaller or equal to this value
		                      (hence more important) are published in the message queue. (Default: 4)
		MaxNumMessages      - Defines the maximum number of messages that can be stored in the message queue (Default: 512)
		TrilinearFiltering  - Enables or disables trilinear filtering for textures. (Values: 0, 1; Default: 1)
		MaxAnisotropy       - Sets the maximum quality for anisotropic filtering. (Values: 1, 2, 4, 8, 16; Default: 1)
		TexCompression      - Enables or disables texture compression; only affects textures that are
		                      loaded after setting the option. (Values: 0, 1; Default: 0)
		SRGBLinearization   - Eanbles or disables gamma-to-linear-space conversion of input textures that are tagged as sRGB (Values: 0, 1; Default: 0)
		LoadTextures        - Enables or disables loading of textures referenced by materials; this can be useful to reduce
		                      loading times for testing. (Values: 0, 1; Default: 1)
		FastAnimation       - Disables or enables inter-frame interpolation for animations. (Values: 0, 1; Default: 1)
		ShadowMapSize       - Sets the size of the shadow map buffer (Values: 128, 256, 512, 1024, 2048; Default: 1024)
		SampleCount         - Maximum number of samples used for multisampled render targets; only affects pipelines
		                      that are loaded after setting the option. (Values: 0, 2, 4, 8, 16; Default: 0)
		WireframeMode       - Enables or disables wireframe rendering
		DebugViewMode       - Enables or disables debug view where geometry is rendered in wireframe without shaders and
		                      lights are visualized using their screen space bounding box. (Values: 0, 1; Default: 0)
		DumpFailedShaders   - Enables or disables storing of shader code that failed to compile in a text file; this can be
		                      useful in combination with the line numbers given back by the shader compiler. (Values: 0, 1; Default: 0)
		GatherTimeStats     - Enables or disables gathering of time stats that are useful for profiling (Values: 0, 1; Default: 1)
		DebugRenderBackend  - Enables or disables logging of render backend diagnostic messages. May require additional actions on
							  application side, like creating a debug opengl context. (Values: 0, 1; Default: 0)
	*/

	const MaxLogLevel        = 1 ;
	const MaxNumMessages     = 2 ;
	const TrilinearFiltering = 3 ;
	const MaxAnisotropy      = 4 ;
	const TexCompression     = 5 ;
	const SRGBLinearization  = 6 ;
	const LoadTextures       = 7 ;
	const FastAnimation      = 8 ;
	const ShadowMapSize      = 9 ;
	const SampleCount        = 10 ;
	const WireframeMode      = 11 ;
	const DebugViewMode      = 12 ;
	const DumpFailedShaders  = 13 ;
	const GatherTimeStats    = 14 ;
	const DebugRenderBackend = 15 ;
};

class H3DStats
{
	/* Enum: H3DStats
			The available engine statistic parameters.

		TriCount          - Number of triangles that were pushed to the renderer
		BatchCount        - Number of batches (draw calls)
		LightPassCount    - Number of lighting passes
		FrameTime         - Time in ms between two h3dFinalizeFrame calls
		AnimationTime     - CPU time in ms spent for animation
		GeoUpdateTime     - CPU time in ms spent for software skinning and morphing
		ParticleSimTime   - CPU time in ms spent for particle simulation and updates
		FwdLightsGPUTime  - GPU time in ms spent for forward lighting passes
		DefLightsGPUTime  - GPU time in ms spent for drawing deferred light volumes
		ShadowsGPUTime    - GPU time in ms spent for generating shadow maps
		ParticleGPUTime   - GPU time in ms spent for drawing particles
		TextureVMem       - Estimated amount of video memory used by textures (in Mb)
		GeometryVMem      - Estimated amount of video memory used by geometry (in Mb),
		ComputeGPUTime	  - GPU time in ms spent for processing compute shaders
	*/
	const TriCount         = 100 ;
	const BatchCount       = 101 ;
	const LightPassCount   = 102 ;
	const FrameTime        = 103 ;
	const AnimationTime    = 104 ;
	const GeoUpdateTime    = 105 ;
	const ParticleSimTime  = 106 ;
	const FwdLightsGPUTime = 107 ;
	const DefLightsGPUTime = 108 ;
	const ShadowsGPUTime   = 109 ;
	const ParticleGPUTime  = 110 ;
	const TextureVMem      = 111 ;
	const GeometryVMem     = 112 ;
	const ComputeGPUTime   = 113 ;
};


class H3DDeviceCapabilities
{
	/* Enum: H3DDeviceCapabilities
	The available GPU capabilities.

	GeometryShaders			- GPU supports runtime geometry generation via geometry shaders
	TessellationShaders     - GPU supports tessellation
	ComputeShaders		    - GPU supports general-purpose computing via compute shaders
	TextureFloatRenderable	- GPU supports rendering to floating-point textures (RGBA16F, RGBA32F)
	TextureCompressionDXT	- GPU supports DXT compressed textures (DXT1, DXT3, DXT5)
	TextureCompressionETC2	- GPU supports ETC2 compressed textures (RGB, RGBA)
	TextureCompressionBPTC	- GPU supports BC6 and BC7 compressed textures
	TextureCompressionASTC	- GPU supports ASTC compressed textures (RGBA)
	*/
	const GeometryShaders        = 200 ;
	const TessellationShaders    = 201 ;
	const ComputeShaders         = 202 ;
	const TextureFloatRenderable = 203 ;
	const TextureCompressionDXT  = 204 ;
	const TextureCompressionETC2 = 205 ;
	const TextureCompressionBPTC = 206 ;
	const TextureCompressionASTC = 207 ;
};

class H3DResTypes
{
	/* Enum: H3DResTypes
			The available resource types.

		Undefined       - An undefined resource, returned by getResourceType in case of error
		SceneGraph      - Scene graph subtree stored in XML format
		Geometry        - Geometrical data containing bones, vertices and triangles
		Animation       - Animation data
		Material        - Material script
		Code            - Text block containing shader source code
		Shader          - Shader program
		Texture         - Texture map
		ParticleEffect  - Particle configuration
		Pipeline        - Rendering pipeline
		ComputeBuffer   - Buffer with arbitrary data that can be accessed and modified by compute shaders
	*/
	const Undefined      = 0 ;
	const SceneGraph     = 1 ;
	const Geometry       = 2 ;
	const Animation      = 3 ;
	const Material       = 4 ;
	const Code           = 5 ;
	const Shader         = 6 ;
	const Texture        = 7 ;
	const ParticleEffect = 8 ;
	const Pipeline       = 9 ;
	const ComputeBuffer  = 10 ;
};

class H3DResFlags
{
	/* Enum: H3DResFlags
			The available flags used when adding a resource.

		NoQuery           - Excludes resource from being listed by queryUnloadedResource function.
		NoTexCompression  - Disables texture compression for Texture resource.
		NoTexMipmaps      - Disables generation of mipmaps for Texture resource.
		TexCubemap        - Sets Texture resource to be a cubemap.
		TexDynamic        - Enables more efficient updates of Texture resource streams.
		TexSRGB           - Indicates that Texture resource is in sRGB color space and should be converted
		                    to linear space when being sampled.
		TexRenderable     - Makes Texture resource usable as render target.
		TexDepthBuffer    - When Textures is renderable, creates a depth buffer along with the color buffer.
	*/
	const NoQuery          = 1 ;
	const NoTexCompression = 2 ;
	const NoTexMipmaps     = 4 ;
	const TexCubemap       = 8 ;
	const TexDynamic       = 16 ;
	const TexSRGB          = 32 ;
	const TexRenderable    = 64 ;
	const TexDepthBuffer   = 128 ;
};

class H3DFormats
{
	/* Enum: H3DFormats
			The available resource stream formats.

		Unknown			- Unknown format
		TEX_R8			- 8-bit texture with one color channel.
		TEX_R16F		- Half float texture with one color channel.
		TEX_R32F		- Float texture with one color channel.
		TEX_RG8			- 8-bit texture with two color channels.
		TEX_RG16F		- Half float texture with two color channels.
		TEX_RG32F		- Float texture with two color channels.
		TEX_BGRA8		- 8-bit BGRA texture. For OpenGL ES it is actually RGBA texture.
		TEX_RGBA16F		- Half float RGBA texture
		TEX_RGBA32F		- Float RGBA texture
		TEX_RGBA32F		- Unsigned integer RGBA texture
		TEX_DXT1		- DXT1 compressed texture
		TEX_DXT3		- DXT3 compressed texture
		TEX_DXT5		- DXT5 compressed texture
		TEX_ETC1		- ETC1 compressed texture
		TEX_RGB8_ETC2	- RGB8 texture compressed in ETC2 format
		TEX_RGBA8_ETC2	- RGBA8 texture compressed in ETC2 format
		TEX_BC6_UF16	- BC6 compressed unsigned half float texture
		TEX_BC6_SF16	- BC6 compressed signed half float texture
		TEX_BC7			- BC7 compressed RGBA texture
		TEX_ASTC_xxx	- ASTC compressed RGBA texture
	*/

	const Unknown        = 0 ;
	const TEX_R8         = 1 ;
	const TEX_R16F       = 2 ;
	const TEX_R32F       = 3 ;
	const TEX_RG8        = 4 ;
	const TEX_RG16F      = 5 ;
	const TEX_RG32F      = 6 ;
	const TEX_BGRA8      = 7 ;
	const TEX_RGBA16F    = 8 ;
	const TEX_RGBA32F    = 9 ;
	const TEX_RGBA32UI   = 10 ;
	const TEX_DXT1       = 11 ;
	const TEX_DXT3       = 12 ;
	const TEX_DXT5       = 13 ;
	const TEX_ETC1       = 14 ;
	const TEX_RGB8_ETC2  = 15 ;
	const TEX_RGBA8_ETC2 = 16 ;
	const TEX_BC6_UF16   = 17 ;
	const TEX_BC6_SF16   = 18 ;
	const TEX_BC7        = 19 ;
	const TEX_ASTC_4x4   = 20 ;
	const TEX_ASTC_5x4   = 21 ;
	const TEX_ASTC_5x5   = 22 ;
	const TEX_ASTC_6x5   = 23 ;
	const TEX_ASTC_6x6   = 24 ;
	const TEX_ASTC_8x5   = 25 ;
	const TEX_ASTC_8x6   = 26 ;
	const TEX_ASTC_8x8   = 27 ;
	const TEX_ASTC_10x5  = 28 ;
	const TEX_ASTC_10x6  = 29 ;
	const TEX_ASTC_10x8  = 30 ;
	const TEX_ASTC_10x10 = 31 ;
	const TEX_ASTC_12x10 = 32 ;
	const TEX_ASTC_12x12 = 33 ;
};


class H3DGeoRes
{
	/* Enum: H3DGeoRes
			The available Geometry resource accessors.

		GeometryElem         - Base element
		GeoIndexCountI       - Number of indices [read-only]
		GeoVertexCountI      - Number of vertices [read-only]
		GeoIndices16I        - Flag indicating whether index data is 16 or 32 bit [read-only]
		GeoIndexStream       - Triangle index data (uint16 or uint32, depending on flag)
		GeoVertPosStream     - Vertex position data (float x, y, z)
		GeoVertTanStream     - Vertex tangent frame data (float nx, ny, nz, tx, ty, tz, tw)
		GeoVertStaticStream  - Vertex static attribute data (float u0, v0,
		                         float4 jointIndices, float4 jointWeights, float u1, v1)
	*/

	const GeometryElem        = 200 ;
	const GeoIndexCountI      = 201 ;
	const GeoVertexCountI     = 202 ;
	const GeoIndices16I       = 203 ;
	const GeoIndexStream      = 204 ;
	const GeoVertPosStream    = 205 ;
	const GeoVertTanStream    = 206 ;
	const GeoVertStaticStream = 207 ;
};


class H3DAnimRes
{
	/* Enum: H3DAnimRes
			The available Animation resource accessors.

		EntityElem      - Stored animation entities (joints and meshes)
		EntFrameCountI  - Number of frames stored for a specific entity [read-only]
	*/

	const EntityElem     = 300 ;
	const EntFrameCountI = 301 ;
};


class H3DMatRes
{
	/* Enum: H3DMatRes
			The available Material resource accessors.

		MaterialElem  - Base element
		SamplerElem   - Sampler element
		UniformElem   - Uniform element
		MatClassStr   - Material class
		MatLinkI      - Material resource that is linked to this material
		MatShaderI    - Shader resource
		SampNameStr   - Name of sampler [read-only]
		SampTexResI   - Texture resource bound to sampler
		UnifNameStr   - Name of uniform [read-only]
		UnifValueF4   - Value of uniform (a, b, c, d)
	*/

	const MaterialElem = 400 ;
	const SamplerElem  = 401 ;
	const UniformElem  = 402 ;
	const MatClassStr  = 403 ;
	const MatLinkI     = 404 ;
	const MatShaderI   = 405 ;
	const SampNameStr  = 406 ;
	const SampTexResI  = 407 ;
	const UnifNameStr  = 408 ;
	const UnifValueF4  = 409 ;
};


class H3DShaderRes
{
	/* Enum: H3DShaderRes
			The available Shader resource accessors.

		ContextElem     - Context element
		SamplerElem     - Sampler element
		UniformElem     - Uniform element
		ContNameStr     - Name of context [read-only]
		SampNameStr     - Name of sampler [read-only]
		SampDefTexResI  - Default texture resouce of sampler [read-only]
		UnifNameStr     - Name of uniform [read-only]
		UnifSizeI       - Size (number of components) of uniform [read-only]
		UnifDefValueF4  - Default value of uniform (a, b, c, d)
	*/
	const ContextElem    = 600 ;
	const SamplerElem    = 601 ;
	const UniformElem    = 602 ;
	const ContNameStr    = 603 ;
	const SampNameStr    = 604 ;
	const SampDefTexResI = 605 ;
	const UnifNameStr    = 606 ;
	const UnifSizeI      = 607 ;
	const UnifDefValueF4 = 608 ;
};

class H3DTexRes
{
	/* Enum: H3DTexRes
			The available Texture resource accessors.

		TextureElem     - Base element
		ImageElem       - Subresources of the texture. A texture consists, depending on the type,
		                  of a number of equally sized slices which again can have a fixed number
		                  of mipmaps. Each image element represents the base image of a slice or
		                  a single mipmap level of the corresponding slice.
		TexFormatI      - Texture format [read-only]
		TexSliceCountI  - Number of slices (1 for 2D texture and 6 for cubemap) [read-only]
		ImgWidthI       - Image width [read-only]
		ImgHeightI      - Image height [read-only]
		ImgPixelStream  - Pixel data of an image. The data layout matches the layout specified
		                  by the texture format with the exception that half-float is converted
		                  to float. The first element in the data array corresponds to the lower
		                  left corner.
	*/

	const TextureElem    = 700 ;
	const ImageElem      = 701 ;
	const TexFormatI     = 702 ;
	const TexSliceCountI = 703 ;
	const ImgWidthI      = 704 ;
	const ImgHeightI     = 705 ;
	const ImgPixelStream = 706 ;
};


class H3DPartEffRes
{
	/* Enum: H3DPartEffRes
			The available ParticleEffect resource accessors.

		ParticleElem     - General particle configuration
		ChanMoveVelElem  - Velocity channel
		ChanRotVelElem   - Angular velocity channel
		ChanSizeElem     - Size channel
		ChanColRElem     - Red color component channel
		ChanColGElem     - Green color component channel
		ChanColBElem     - Blue color component channel
		ChanColAElem     - Alpha channel
		PartLifeMinF     - Minimum value of random life time (in seconds)
		PartLifeMaxF     - Maximum value of random life time (in seconds)
		ChanStartMinF    - Minimum for selecting initial random value of channel
		ChanStartMaxF    - Maximum for selecting initial random value of channel
		ChanEndRateF     - Remaining percentage of initial value when particle is dying
	*/

	const ParticleElem    = 800 ;
	const ChanMoveVelElem = 801 ;
	const ChanRotVelElem  = 802 ;
	const ChanSizeElem    = 803 ;
	const ChanColRElem    = 804 ;
	const ChanColGElem    = 805 ;
	const ChanColBElem    = 806 ;
	const ChanColAElem    = 807 ;
	const PartLifeMinF    = 808 ;
	const PartLifeMaxF    = 809 ;
	const ChanStartMinF   = 810 ;
	const ChanStartMaxF   = 811 ;
	const ChanEndRateF    = 812 ;
	const ChanDragElem    = 813 ;
};


class H3DPipeRes
{
	/* Enum: H3DPipeRes
			The available Pipeline resource accessors.

		StageElem         - Pipeline stage
		StageNameStr      - Name of stage [read-only]
		StageActivationI  - Flag indicating whether stage is active
	*/
	const StageElem        = 900 ;
	const StageNameStr     = 901 ;
	const StageActivationI = 902 ;
};


class H3DComputeBufRes
{
	/* Enum: H3DComputeBufRes
	The available ComputeBuffer resource accessors.

	ComputeBufElem				- General compute buffer configuration
	DrawParamsElem				- Specifies parameters for shader bindings
	CompBufDataSizeI			- Size of the buffer
	CompBufDrawableI			- Use this compute buffer as a source of vertices for drawing [0, 1]. Default - 0
	DrawParamsNameStr			- Specifies the name of the parameter in the buffer (used for binding of shader variable to buffer data)
	DrawParamsSizeI				- Specifies the size of one parameter in the buffer. Example: for vertex position (3 floats) size should be 3
	DrawParamsOffsetI			- Specifies the offset of parameter in the buffer (in bytes)
	                              Example: for first parameter offset is 0. For second (if 1st parameter uses 3 floats) it is 12
	DrawParamsCountI			- Total number of specified vertex binding parameters [read-only]

	*/

	const ComputeBufElem    = 1000 ;
	const DrawParamsElem    = 1001 ;
	const CompBufDataSizeI  = 1002 ;
	const CompBufDrawableI  = 1003 ;
	const DrawParamsNameStr = 1004 ;
	const DrawParamsSizeI   = 1005 ;
	const DrawParamsOffsetI = 1006 ;
	const DrawParamsCountI  = 1007 ;
};


class H3DNodeTypes
{
	/*	Enum: H3DNodeTypes
			The available scene node types.

		Undefined  - An undefined node type, returned by getNodeType in case of error
		Group      - Group of different scene nodes
		Model      - 3D model with optional skeleton
		Mesh       - Subgroup of a model with triangles of one material
		Joint      - Joint for skeletal animation
		Light      - Light source
		Camera     - Camera giving view on scene
		Emitter    - Particle system emitter
		Compute	   - Compute node, used for drawing compute results
	*/

	const Undefined = 0 ;
	const Group     = 1 ;
	const Model     = 2 ;
	const Mesh      = 3 ;
	const Joint     = 4 ;
	const Light     = 5 ;
	const Camera    = 6 ;
	const Emitter   = 7 ;
	const Compute   = 8 ;

	const Terrain   = 100 ; // EXTENSION
};


class H3DNodeFlags
{
	/*	Enum: H3DNodeFlags
			The available scene node flags.

		NoDraw         - Excludes scene node from all rendering
		NoCastShadow   - Excludes scene node from list of shadow casters
		NoRayQuery     - Excludes scene node from ray intersection queries
		Inactive       - Deactivates scene node so that it is completely ignored
		                 (combination of all flags above)
	*/

	const NoDraw       = 1 ;
	const NoCastShadow = 2 ;
	const NoRayQuery   = 4 ;
	const Inactive     = 7 ; // NoDraw | NoCastShadow | NoRayQuery
};


class H3DNodeParams
{
	/*	Enum: H3DNodeParams
			The available scene node parameters.

		NameStr        - Name of the scene node
		AttachmentStr  - Optional application-specific meta data for a node encapsulated
		                 in an 'Attachment' XML string
	*/

	const NameStr       = 1 ;
	const AttachmentStr = 2 ;
};



class H3DModel
{
	/*	Enum: H3DModel
			The available Model node parameters

		GeoResI      - Geometry resource used for the model
		SWSkinningI  - Enables or disables software skinning (default: 0)
		LodDist1F    - Distance to camera from which on LOD1 is used (default: infinite)
		               (must be a positive value larger than 0.0)
		LodDist2F    - Distance to camera from which on LOD2 is used
		               (may not be smaller than LodDist1) (default: infinite)
		LodDist3F    - Distance to camera from which on LOD3 is used
		               (may not be smaller than LodDist2) (default: infinite)
		LodDist4F    - Distance to camera from which on LOD4 is used
		               (may not be smaller than LodDist3) (default: infinite)
		AnimCountI   - Number of active animation stages [read-only]
	*/

	const GeoResI     = 200 ;
	const SWSkinningI = 201 ;
	const LodDist1F   = 202 ;
	const LodDist2F   = 203 ;
	const LodDist3F   = 204 ;
	const LodDist4F   = 205 ;
	const AnimCountI  = 206 ;
};


class H3DMeshPrimType
{
	/*	Enum: H3DMeshParams
			The available Mesh node primitive types.

		TriangleList - Mesh is drawn with triangles.
		LineList     - Mesh is drawn with lines.
		Patches      - Mesh is drawn with patches. Only used for tessellated meshes.
		Points       - Mesh is represented as points.
	 */

	const TriangleList = 0 ;
	const LineList     = 1 ;
	const Patches      = 2 ;
	const Points       = 3 ;
};


class H3DMesh
{
	/*	Enum: H3DMesh
			The available Mesh node parameters.

		MatResI      - Material resource used for the mesh
		BatchStartI  - First triangle index of mesh in Geometry resource of parent Model node [read-only]
		BatchCountI  - Number of triangle indices used for drawing mesh [read-only]
		VertRStartI  - First vertex in Geometry resource of parent Model node [read-only]
		VertREndI    - Last vertex in Geometry resource of parent Model node [read-only]
		LodLevelI    - LOD level of Mesh; the mesh is only rendered if its LOD level corresponds to
		               the model's current LOD level which is calculated based on the LOD distances (default: 0)
	*/

	const MatResI     = 300 ;
	const BatchStartI = 301 ;
	const BatchCountI = 302 ;
	const VertRStartI = 303 ;
	const VertREndI   = 304 ;
	const LodLevelI   = 305 ;
};

class H3DJoint
{
	/*	Enum: H3DJoint
			The available Joint node parameters.

		JointIndexI  - Index of joint in Geometry resource of parent Model node [read-only]
	*/

	const JointIndexI = 400 ;
};


class H3DLight
{
	/*	Enum: H3DLight
			The available Light node parameters.

		MatResI             - Material resource used for the light
		RadiusF             - Radius of influence (default: 100.0)
		FovF                - Field of view (FOV) angle (default: 90.0)
		ColorF3             - Diffuse color RGB (default: 1.0, 1.0, 1.0)
		ColorMultiplierF    - Diffuse color multiplier for altering intensity, mainly useful for HDR (default: 1.0)
		ShadowMapCountI     - Number of shadow maps used for light source (values: 0, 1, 2, 3, 4; default: 0)]
		ShadowSplitLambdaF  - Constant determining segmentation of view frustum for Parallel Split Shadow Maps (default: 0.5)
		ShadowMapBiasF      - Bias value for shadow mapping to reduce shadow acne (default: 0.005)
		LightingContextStr  - Name of shader context used for computing lighting
		ShadowContextStr    - Name of shader context used for generating shadow map
	*/

	const MatResI            = 500 ;
	const RadiusF            = 501 ;
	const FovF               = 502 ;
	const ColorF3            = 503 ;
	const ColorMultiplierF   = 504 ;
	const ShadowMapCountI    = 505 ;
	const ShadowSplitLambdaF = 506 ;
	const ShadowMapBiasF     = 507 ;
	const LightingContextStr = 508 ;
	const ShadowContextStr   = 509 ;
};


class H3DCamera
{
	/*	Enum: H3DCamera
			The available Camera node parameters.

		PipeResI         - Pipeline resource used for rendering
		OutTexResI       - 2D Texture resource used as output buffer (can be 0 to use main framebuffer) (default: 0)
		OutBufIndexI     - Index of the output buffer for stereo rendering (values: 0 for left eye, 1 for right eye) (default: 0)
		LeftPlaneF       - Coordinate of left plane relative to near plane center (default: -0.055228457)
		RightPlaneF      - Coordinate of right plane relative to near plane center (default: 0.055228457)
		BottomPlaneF     - Coordinate of bottom plane relative to near plane center (default: -0.041421354f)
		TopPlaneF        - Coordinate of top plane relative to near plane center (default: 0.041421354f)
		NearPlaneF       - Distance of near clipping plane (default: 0.1)
		FarPlaneF        - Distance of far clipping plane (default: 1000)
		ViewportXI       - Position x-coordinate of the lower left corner of the viewport rectangle (default: 0)
		ViewportYI       - Position y-coordinate of the lower left corner of the viewport rectangle (default: 0)
		ViewportWidthI   - Width of the viewport rectangle (default: 320)
		ViewportHeightI  - Height of the viewport rectangle (default: 240)
		OrthoI           - Flag for setting up an orthographic frustum instead of a perspective one (default: 0)
		OccCullingI      - Flag for enabling occlusion culling (default: 0)
	*/

	const PipeResI        = 600 ;
	const OutTexResI      = 601 ;
	const OutBufIndexI    = 602 ;
	const LeftPlaneF      = 603 ;
	const RightPlaneF     = 604 ;
	const BottomPlaneF    = 605 ;
	const TopPlaneF       = 606 ;
	const NearPlaneF      = 607 ;
	const FarPlaneF       = 608 ;
	const ViewportXI      = 609 ;
	const ViewportYI      = 610 ;
	const ViewportWidthI  = 611 ;
	const ViewportHeightI = 612 ;
	const OrthoI          = 613 ;
	const OccCullingI     = 614 ;
};


class H3DEmitter
{
	/*	Enum: H3DEmitter
			The available Emitter node parameters.

		MatResI        - Material resource used for rendering
		PartEffResI    - ParticleEffect resource which configures particle properties
		MaxCountI      - Maximal number of particles living at the same time
		RespawnCountI  - Number of times a single particle is recreated after dying (-1 for infinite)
		DelayF         - Time in seconds before emitter begins creating particles (default: 0.0)
		EmissionRateF  - Maximal number of particles to be created per second (default: 0.0)
		SpreadAngleF   - Angle of cone for random emission direction (default: 0.0)
		ForceF3        - Force vector XYZ applied to particles (default: 0.0, 0.0, 0.0)
	*/

	const MatResI       = 700 ;
	const PartEffResI   = 701 ;
	const MaxCountI     = 702 ;
	const RespawnCountI = 703 ;
	const DelayF        = 704 ;
	const EmissionRateF = 705 ;
	const SpreadAngleF  = 706 ;
	const ForceF3       = 707 ;
};

class H3DComputeNode
{
	/*	Enum: H3DComputeNode
			The available compute node parameters.

		MatResI        - Material resource used for rendering
		CompBufResI    - Compute buffer resource that is used as data storage
		AABBMinF       - Minimum of the node's AABB (should be set separately for x, y, z components)
		AABBMaxF       - Maximum of the node's AABB (should be set separately for x, y, z components)
		DrawTypeI	   - Specifies how to draw data in the buffer (see H3DMeshPrimType)
		ElementsCountI - Specifies number of elements to draw (Example: for 1000 points - 1000, for 10 triangles - 10)
	*/

	const MatResI        = 800 ;
	const CompBufResI    = 801 ;
	const AABBMinF       = 802 ;
	const AABBMaxF       = 803 ;
	const DrawTypeI      = 804 ;
	const ElementsCountI = 805 ;
};

class H3DModelUpdateFlags
{
	/*	Enum: H3DModelUpdateFlags
			The available flags for h3dUpdateModel.

		Animation  - Apply animation
		Geometry   - Apply morphers and software skinning
		ChildNodes - Manually update child nodes and calculate their AABB. Useful when meshes are added procedurally to model
	*/

	const Animation  = 1 ;
	const Geometry   = 2 ;
	const ChildNodes = 3 ;
};

class H3DEXTTerrain
{
	/*	Enum: H3DEXTTerrain
			The available Terrain node parameters.

		HeightTexResI  - Height map texture; must be square and a power of two [write-only]
		MatResI        - Material resource used for rendering the terrain
		MeshQualityF   - Constant controlling the overall resolution of the terrain mesh (default: 50.0)
		SkirtHeightF   - Height of the skirts used to hide cracks (default: 0.1)
		BlockSizeI     - Size of a terrain block that is drawn in a single render call; must be 2^n+1 (default: 17)
	*/

	const HeightTexResI = 10000 ;
	const MatResI       = 10001 ;
	const MeshQualityF  = 10002 ;
	const SkirtHeightF  = 10003 ;
	const BlockSizeI    = 10004 ;
};


class Horde3D
{

	//----------------------------------------------------------------------------------
	// Const Definition
	//----------------------------------------------------------------------------------


	/*	Constants: Predefined constants
		H3DRootNode  - Scene root node handle
	*/
	const RootNode = 1;


	//----------------------------------------------------------------------------------
	// FFI initialisation
	//----------------------------------------------------------------------------------

	public static $ffi;
	
	public static $ffi_typeof_vec2;
	public static $ffi_typeof_vec3;
	public static $ffi_typeof_vec4;
	
	public static $ffi_typeof_quat;
	
	public static $ffi_typeof_mat4_union;
	public static $ffi_typeof_mat4_union_p;
	
	public static $ffi_typeof_float_p;

	public static function Horde3D()
	{
		if ( static::$ffi ) 
		{ 
			debug_print_backtrace();
			exit("Horde3D::Horde3D() already init".PHP_EOL); 
		}
		
		$cdef = __DIR__ . '/horde3d.ffi.php.h';
		
		$lib_dir = defined('FFI_LIB_DIR') ? FFI_LIB_DIR : 'lib' ;
		
		$slib = "./$lib_dir/libHorde3D.".PHP_SHLIB_SUFFIX;
		
		static::$ffi = FFI::cdef( file_get_contents( $cdef ) , $slib );
		
		// ----
		
		static::$ffi_typeof_float_p = static::$ffi->type("float*");
		
		if ( class_exists( "GLM" ) )
		{	
			static::$ffi_typeof_vec2         =    GLM::$ffi_typeof_vec2;
			static::$ffi_typeof_vec3         =    GLM::$ffi_typeof_vec3;
			static::$ffi_typeof_vec4         =    GLM::$ffi_typeof_vec4;
			
			static::$ffi_typeof_quat         =    GLM::$ffi_typeof_quat;
			
			static::$ffi_typeof_mat4_union   =    GLM::$ffi->type("union Matrix4f  { float f[16] ; mat4 m ; }   ");
			static::$ffi_typeof_mat4_union_p =    GLM::$ffi->type("union Matrix4fp { float f[16] ; mat4 m ; } * ");
		}
		else
		{
			static::$ffi_typeof_vec2         = static::$ffi->type("float[2]");
			static::$ffi_typeof_vec3         = static::$ffi->type("float[3]");
			static::$ffi_typeof_vec4         = static::$ffi->type("float[4]");
			
			static::$ffi_typeof_quat         = static::$ffi->type("float[4]");
			
			static::$ffi_typeof_mat4_union   = static::$ffi->type("union Matrix4f  { float f[16] ; float m[4][4] ; }   ");
			static::$ffi_typeof_mat4_union_p = static::$ffi->type("union Matrix4fp { float f[16] ; float m[4][4] ; } * ");
		}
	}


	public static function __callStatic( $method , $args )
	{
		$callable = [static::$ffi, 'h3d'.$method];
		return $callable(...$args);
	}

	//----------------------------------------------------------------------------------
	// Helpers
	//----------------------------------------------------------------------------------

	public static function GetNodeTransform( $node )
	{
		$T = FFI::new( static::$ffi_typeof_vec3 );
		$R = FFI::new( static::$ffi_typeof_vec3 );
		$S = FFI::new( static::$ffi_typeof_vec3 );

		static::$ffi->h3dGetNodeTransform( $node ,
				FFI::addr( $T[0] ) , FFI::addr( $T[1] ) , FFI::addr( $T[2] ) ,
				FFI::addr( $R[0] ) , FFI::addr( $R[1] ) , FFI::addr( $R[2] ) ,
				FFI::addr( $S[0] ) , FFI::addr( $S[1] ) , FFI::addr( $S[2] ) ,
		);

		return [ $T , $R , $S ];
	}

	public static function SetNodeTransform( $node , $tx,$ty=null,$tz=null , $rx=null,$ry=null,$rz=null , $sx=null,$sy=null,$sz=null )
	{
		if ( is_array( $tx ) )
		{
			if ( count( $tx ) == 3 ) // [ [ tx,ty,tz ] , [ rx,ry,rz ] , [ sx,sy,sz ] ]
			{
				list( list( $tx , $ty , $tz ) , list( $rx , $ry , $rz ) , list( $sx , $sy , $sz ) ) = $tx ;
			}
			else
			{
				list( $tx,$ty,$tz , $rx,$ry,$rz , $sx,$sy ,$sz ) = $tx ;
			}
		}

		return static::$ffi->h3dSetNodeTransform( $node , $tx,$ty,$tz , $rx,$ry ,$rz , $sx,$sy ,$sz );
	}

	public static function GetNodeTransMatRel( $node )
	{
		$Mp = static::$ffi->new( static::$ffi_typeof_mat4_union_p );
		
		$float_pp = FFI::addr( FFI::cast( static::$ffi_typeof_float_p , $Mp ) );
				
		static::$ffi->h3dGetNodeTransMats( $node , $float_pp , null );
		
		return $Mp[0];
	}

	public static function GetNodeTransMatAbs( $node )
	{
		$Mp = static::$ffi->new( static::$ffi_typeof_mat4_union_p );
		
		$float_pp = FFI::addr( FFI::cast( static::$ffi_typeof_float_p , $Mp ) );
		
		static::$ffi->h3dGetNodeTransMats( $node , null , $float_pp );
		
		return $Mp[0];
	}
	
	public static function GetNodeTransMats( $node )
	{
		$Rp = static::$ffi->new( static::$ffi_typeof_mat4_union_p );
		$Ap = static::$ffi->new( static::$ffi_typeof_mat4_union_p );
		
		$R_float_pp = FFI::addr( FFI::cast( static::$ffi_typeof_float_p , $Mp ) );
		$A_float_pp = FFI::addr( FFI::cast( static::$ffi_typeof_float_p , $Ap ) );
		
		static::$ffi->h3dGetNodeTransMats( $node , $R_float_pp , $A_float_pp );
		
		return [ $Rp[0] , $Ap[0] ];
	}
}
