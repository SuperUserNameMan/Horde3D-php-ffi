<?php

/**
	PHP 3D math lib converted from : https://github.com/horde3d/Horde3D/utMath.h

	- class Vec3f
	- class Quaternion
	- class Matrix4f
	- class Plane

	- Intersection::EPSILON
	- Intersection::RayTriangle()
	- Intersection::RayAABB()

	- Vec3f::DistToAABB()
*/

//==============================================================================
// Vec3f ; Quaternion ; Matrix4f
//==============================================================================

class Vec3f
{
	public float $x = 0.0 ;
	public float $y = 0.0 ;
	public float $z = 0.0 ;

// ------------------ STATIC METHODS ----------------------------

	static public function is_vector( $V )
	{
		return is_object( $V ) && ( get_class( $V ) == "Vec3f" ) ;
	}

	static public function Cast( $V )
	{
		if ( static::is_vector( $V ) ) return $V;

		return new Vec3f( $V );
	}

// ------------------- INIT ---------------------------

	public function __construct( $V = 0.0 )
	{
		$this->Set( $V );
	}

	public function Set( $V )
	{
		if ( is_array( $V ) )
		{
			$this->x = $V[0] ?? 0.0 ;
			$this->y = $V[1] ?? 0.0 ;
			$this->z = $V[2] ?? 0.0 ;
		}
		else
		if ( is_object( $V ) )
		{
			$this->x = $V->x ;
			$this->y = $V->y ;
			$this->z = $V->z ;
		}
		else
		{
			$V = floatval( $V );

			$this->x = $V ;
			$this->y = $V ;
			$this->z = $V ;
		}

		return $this;
	}

	public function Clone()
	{
		return new Vec3f( $this );
	}


	public function toArray()
	{
		return [ $this->x , $this->y , $this->z ];
	}

// ------------------- MATH ---------------------------

	public function Equal( $V )
	{
		if ( is_array( $V ) )
		{
			return ( $this->x == $V[0] ) && ( $this->y == $V[1] ) && ( $this->z == $V[2] ) ;
		}

		if ( is_object( $V ) )
		{
			return ( $this->x == $V->x ) && ( $this->y == $V->y ) && ( $this->z == $V->z ) ;
		}

		$V = floatval( $V );

		return ( $this->x == $V ) && ( $this->y == $V ) && ( $this->z == $V ) ;
	}


	public function Add( $V )
	{
		if ( is_array( $V ) )
		{
			$this->x += $V[0] ?? 0.0 ;
			$this->y += $V[1] ?? 0.0 ;
			$this->z += $V[2] ?? 0.0 ;
		}
		else
		if ( is_object( $V ) )
		{
			$this->x += $V->x ;
			$this->y += $V->y ;
			$this->z += $V->z ;
		}
		else
		{
			$V = floatval( $V );
			$this->x += $V ;
			$this->y += $V ;
			$this->z += $V ;
		}

		return $this;
	}


	public function Sub( $V )
	{
		if ( is_array( $V ) )
		{
			$this->x -= $V[0] ?? 0.0 ;
			$this->y -= $V[1] ?? 0.0 ;
			$this->z -= $V[2] ?? 0.0 ;
		}
		else
		if ( is_object( $V ) )
		{
			$this->x -= $V->x ;
			$this->y -= $V->y ;
			$this->z -= $V->z ;
		}
		else
		{
			$V = floatval( $V );
			$this->x -= $V ;
			$this->y -= $V ;
			$this->z -= $V ;
		}

		return $this;
	}


	public function Mult( $V )
	{
		if ( is_array( $V ) )
		{
			$this->x *= $V[0] ?? 0.0 ;
			$this->y *= $V[1] ?? 0.0 ;
			$this->z *= $V[2] ?? 0.0 ;
		}
		else
		if ( is_object( $V ) )
		{
			$this->x *= $V->x ;
			$this->y *= $V->y ;
			$this->z *= $V->z ;
		}
		else
		{
			$V = floatval( $V );
			$this->x *= $V ;
			$this->y *= $V ;
			$this->z *= $V ;
		}

		return $this;
	}


	public function Div( $V )
	{
		if ( is_array( $V ) )
		{
			$this->x /= $V[0] ?? 0.0 ;
			$this->y /= $V[1] ?? 0.0 ;
			$this->z /= $V[2] ?? 0.0 ;
		}
		else
		if ( is_object( $V ) )
		{
			$this->x /= $V->x ;
			$this->y /= $V->y ;
			$this->z /= $V->z ;
		}
		else
		{
			$V = floatval( $V );
			$this->x /= $V ;
			$this->y /= $V ;
			$this->z /= $V ;
		}

		return $this;
	}

	public function Dot( $V )
	{
		if ( is_array( $V ) )
		{
			return 0.0
				+ ( $this->x * $V[0] )
				+ ( $this->y * $V[1] )
				+ ( $this->z * $V[2] )
				;
		}

		if ( is_object( $V ) )
		{
			return 0.0
				+ ( $this->x * $V->x )
				+ ( $this->y * $V->y )
				+ ( $this->z * $V->z )
				;
		}

		$V = floatval( $V );

		return 0.0
			+ ( $this->x * $V )
			+ ( $this->y * $V )
			+ ( $this->z * $V )
			;
	}

	public function Cross( $V )
	{
		if ( is_array( $V ) )
		{
			$X = ( $this->y * $V[2] ) - ( $this->z * $V[1] ) ;
			$Y = ( $this->z * $V[0] ) - ( $this->x * $V[2] ) ;
			$Z = ( $this->x * $V[1] ) - ( $this->y * $V[0] ) ;
		}
		else
		if ( is_object( $V ) )
		{
			$X = ( $this->y * $V->z ) - ( $this->z * $V->y ) ;
			$Y = ( $this->z * $V->x ) - ( $this->x * $V->z ) ;
			$Z = ( $this->x * $V->y ) - ( $this->y * $V->x ) ;
		}
		else
		{
			$V = floatval( $V );

			$X = ( $this->y * $V ) - ( $this->z * $V ) ;
			$Y = ( $this->z * $V ) - ( $this->x * $V ) ;
			$Z = ( $this->x * $V ) - ( $this->y * $V ) ;
		}

		$this->x = $X ;
		$this->y = $Y ;
		$this->z = $Z ;

		return $this;
	}


	public function Len()
	{
		return sqrt( $this->x**2 + $this->y**2 + $this->z**2 );
	}

	public function LenSqr()
	{
		return ( $this->x**2 + $this->y**2 + $this->z**2 );
	}

	public function Normalise()
	{
		$_L = $this->Len() ;

		if ( $_L > 0.0 ) $_L = 1.0 / $_L ;

		$this->Mult( $_L );

		return $this;
	}

	public function toRotation()
	{
		// Assumes that the unrotated view vector is (0, 0, -1)

		$X = $this->x ;
		$Y = $this->x ;

		if ( $this->y != 0.0 )
		{
			$X = atan2( $this->y , sqrt( $this->x**2 , $this->z**2 ) );
		}

		if ( $this->x != 0.0 || $this->y != 0.0 )
		{
			$Y = atan2( -$this->x , -$this->z );
		}

		$this->x = $X ;
		$this->y = $Y ;

		return $this;
	}

	public function Lerp( $V , float $f )
	{
		if ( is_array( $V ) )
		{
			$this->x += ( $V[0] - $this->x ) * $f ;
			$this->y += ( $V[1] - $this->y ) * $f ;
			$this->z += ( $V[2] - $this->z ) * $f ;

			return $this;
		}

		if ( is_object( $V ) )
		{
			$this->x += ( $V->x - $this->x ) * $f ;
			$this->y += ( $V->y - $this->y ) * $f ;
			$this->z += ( $V->z - $this->z ) * $f ;

			return $this;
		}

		$V = floatval( $V );

		$this->x += ( $V - $this->x ) * $f ;
		$this->y += ( $V - $this->y ) * $f ;
		$this->z += ( $V - $this->z ) * $f ;

		return $this;
	}

	public function DistToAABB( $aabb_mins , $aabb_maxs )
	{
		$aabb_mins = Vec3f::cast( $aabb_mins );
		$aabb_maxs = Vec3f::cast( $aabb_maxs );

		$center = $aabb_mins->Clone()->Add( $aabb_maxs )->Mult( 0.5 );
		$extent = $aabb_maxs->Clone()->Sub( $aabb_mins )->Mult( 0.5 );

		$X = max( 0.0 , abs( $this->x - $center->x ) - $extent->x ) ;
		$Y = max( 0.0 , abs( $this->y - $center->y ) - $extent->y ) ;
		$Z = max( 0.0 , abs( $this->z - $center->z ) - $extent->z ) ;

		return sqrt( $X**2 + $Y**2 + $Z**2 );
	}
}

class Quaternion
{
	public float $x = 0.0 ;
	public float $y = 0.0 ;
	public float $z = 0.0 ;
	public float $w = 0.0 ;

// ---------------- STATIC METHODS ------------------------------

	static public function is_quaternion( $Q )
	{
		return is_object( $Q ) && ( get_class( $Q ) == "Quaternion" ) ;
	}

// ------------------ INIT ----------------------------

	function __construct( $Q )
	{
		$this->Set( $Q );
	}

	public function Set( $Q )
	{
		if ( is_array( $Q ) )
		{
			if ( count( $Q ) == 3 )
			{
				// Euler :
				$roll  = new Quaternion( [ sin( $Q[0] * 0.5 ) , 0.0 , 0.0 , cos( $Q[0] * 0.5 ) ] );
				$pitch = new Quaternion( [ 0.0 , sin( $Q[1] * 0.5 ) , 0.0 , cos( $Q[1] * 0.5 ) ] );
				$yaw   = new Quaternion( [ 0.0 , 0.0 , sin( $Q[2] * 0.5 ) , cos( $Q[2] * 0.5 ) ] );

				$this->Set( $pitch->Mult( $roll )->Mult( $yaw ) );
			}
			else
			{
				$this->x = $Q[0] ?? 0.0 ;
				$this->y = $Q[1] ?? 0.0 ;
				$this->z = $Q[2] ?? 0.0 ;
				$this->w = $Q[3] ?? 0.0 ;
			}

		}
		else
		if ( is_object( $Q ) )
		{
			$this->x = $Q->x ;
			$this->y = $Q->y ;
			$this->z = $Q->z ;
			$this->w = $Q->w ;
		}
		else
		{
			$Q = floatval( $Q );

			$this->x = $Q ;
			$this->y = $Q ;
			$this->z = $Q ;
			$this->w = $Q ;
		}

		return $this;
	}

	public function Clone()
	{
		return new Quaternion( $this );
	}

	public function toArray()
	{
		return [ $this->x , $this->y , $this->z , $this->w ];
	}

// -------------- MATH --------------------------------

	public function Equal( $Q )
	{
		if ( is_array( $Q ) )
		{
			return ( $this->x == $Q[0] ) && ( $this->y == $Q[1] ) && ( $this->z == $Q[2] ) && ( $this->w == $Q[3] ) ;
		}

		if ( is_object( $Q ) )
		{
			return ( $this->x == $Q->x ) && ( $this->y == $Q->y ) && ( $this->z == $Q->z ) && ( $this->w == $Q->w ) ;
		}

		$Q = floatval( $Q );

		return ( $this->x == $Q ) && ( $this->y == $Q ) && ( $this->z == $Q ) && ( $this->w == $Q ) ;
	}

	public function Mult( $Q )
	{
		if ( is_array( $Q ) )
		{
			$X = ( $this->y * $Q[2] ) - ( $this->z * $Q[1] ) + ( $Q[0] * $this->w ) + ( $this->x * $Q[3] ) ;
			$Y = ( $this->z * $Q[0] ) - ( $this->x * $Q[2] ) + ( $Q[1] * $this->w ) + ( $this->y * $Q[3] ) ;
			$Z = ( $this->x * $Q[1] ) - ( $this->y * $Q[0] ) + ( $Q[2] * $this->w ) + ( $this->z * $Q[3] ) ;

			$W = ( $this->w * $Q[3] ) - ( ( $this->x * $Q[0] ) + ( $this->y * $Q[1] ) + ( $this->z * $Q[2] ) ) ;
		}
		else
		if ( is_object( $Q ) )
		{
			$X = ( $this->y * $Q->z ) - ( $this->z * $Q->y ) + ( $Q->x * $this->w ) + ( $this->x * $Q->w ) ;
			$Y = ( $this->z * $Q->x ) - ( $this->x * $Q->z ) + ( $Q->y * $this->w ) + ( $this->y * $Q->w ) ;
			$Z = ( $this->x * $Q->y ) - ( $this->y * $Q->x ) + ( $Q->z * $this->w ) + ( $this->z * $Q->w ) ;

			$W = ( $this->w * $Q->w ) - ( ( $this->x * $Q->x ) + ( $this->y * $Q->y ) + ( $this->z * $Q->z ) ) ;
		}
		else
		{
			$Q = floatval( $Q );

			$X = ( $this->y * $Q ) - ( $this->z * $Q ) + ( $Q * $this->w ) + ( $this->x * $Q ) ;
			$Y = ( $this->z * $Q ) - ( $this->x * $Q ) + ( $Q * $this->w ) + ( $this->y * $Q ) ;
			$Z = ( $this->x * $Q ) - ( $this->y * $Q ) + ( $Q * $this->w ) + ( $this->z * $Q ) ;

			$W = ( $this->w * $Q ) - ( ( $this->x * $Q ) + ( $this->y * $Q ) + ( $this->z * $Q ) ) ;
		}

		$this->x = $X ;
		$this->y = $Y ;
		$this->z = $Z ;
		$this->w = $W ;

		return $this;
	}

	public function Slerp( $Q , float $t )
	{
		// Spherical linear interpolation between two quaternions
		// Note: SLERP is not commutative

		if ( ! is_object( $Q ) ) $Q = new Quaternion( $Q );

		$X = $Q->x ;
		$Y = $Q->y ;
		$Z = $Q->z ;
		$W = $Q->w ;

		$cosTheta = ( $this->x * $X ) + ( $this->y * $Y ) + ( $this->z * $Z ) + ( $this->w * $W ) ;

		if ( $cosTheta < 0.0 )
		{
			$cosTheta = -$cosTheta ;
			$X = -$Q->x ;
			$Y = -$Q->y ;
			$Z = -$Q->z ;
			$W = -$Q->w ;
		}

		$scale0 = 1.0 - $t ;
		$scale1 = $t ;

		if ( ( 1.0 - $cosTheta ) > 0.001 )
		{
			// SLERP
			$thetha   = acos( $cosTheta );
			$sinTheta =  sin( $thetha   );

			$scale0 = sin( $scale0 * $thetha ) / $sinTheta ;
			$scale1 = sin( $scale1 * $thetha ) / $sinTheta ;
		}

		// final quaternion :

		$this->x = ( $this->x * $scale0 ) + ( $X * $scale1 ) ;
		$this->y = ( $this->y * $scale0 ) + ( $Y * $scale1 ) ;
		$this->z = ( $this->z * $scale0 ) + ( $Z * $scale1 ) ;
		$this->w = ( $this->w * $scale0 ) + ( $W * $scale1 ) ;

		return $this;
	}

	public function Nlerp( $Q , float $t )
	{
		// Normalized linear quaternion interpolation
		// Note: NLERP is faster than SLERP and commutative but does not yield constant velocity

		if ( ! is_object( $Q ) ) $Q = new Quaternion( $Q );

		$cosTheta = ( $this->x * $Q->x ) + ( $this->y * $Q->y ) + ( $this->z * $Q->z ) + ( $this->w * $Q->w ) ;

		if ( $cosTheta < 0.0 )
		{
			$X = $this->x + ( -$Q->x - $this->x ) * $t ;
			$Y = $this->y + ( -$Q->y - $this->y ) * $t ;
			$Z = $this->z + ( -$Q->z - $this->z ) * $t ;
			$W = $this->w + ( -$Q->w - $this->w ) * $t ;
		}
		else
		{
			$X = $this->x + ( $Q->x - $this->x ) * $t ;
			$Y = $this->y + ( $Q->y - $this->y ) * $t ;
			$Z = $this->z + ( $Q->z - $this->z ) * $t ;
			$W = $this->w + ( $Q->w - $this->w ) * $t ;
		}

		// return normalised quaternion

		$invLen = 1.0 / sqrt( $X**2 + $Y**2 + $Z**2 + $W**2 );

		$this->x = $X * $invLen ;
		$this->y = $Y * $invLen ;
		$this->z = $Z * $invLen ;
		$this->w = $W * $invLen ;

		return $this;
	}

	public function Inverted()
	{
		$len = $this->x**2 + $this->y**2 + $this->z**2 + $this->w**2 ;

		if ( $len > 0.0 )
		{
			$invLen = 1.0 / $len ;

			$this->x *= -$invLen ;
			$this->y *= -$invLen ;
			$this->z *= -$invLen ;

			$this->w *= $invLen ;
		}

		return $this;
	}
}


class Matrix4f
{

// -------------- CONST --------------------------------

	public const IDENTITY = [
		[ 1.0 , 0.0 , 0.0 , 0.0 ], // X Axis	0|  0  1  2  3
		[ 0.0 , 1.0 , 0.0 , 0.0 ], // Y Axis    1|  4  5  6  7
		[ 0.0 , 0.0 , 1.0 , 0.0 ], // Z Axis    2|  8  9 10 11
		[ 0.0 , 0.0 , 0.0 , 1.0 ], // Position  3| 12 13 14 15
	];

// --------------- DATA ----------------------------------------------------

	public $c = self::IDENTITY ;

// ----------------- STATIC METHODS --------------------------------------------------

	static public function TransMat( $V )
	{
		if ( ! is_object( $V ) ) $V = new Vec3f( $V );

		$M = new Matrix4f();

		$M->c[3] = [ $V->x , $V->y , $V->z , 1.0 ];

		return $M;
	}

	static public function ScaleMat( $V )
	{
		if ( ! is_object( $V ) ) $V = new Vec3f( $V );

		$M = new Matrix4f();

		$M->c[0][0] = $V->x ;
		$M->c[1][1] = $V->y ;
		$M->c[2][2] = $V->z ;

		return $M;
	}

	static public function RotMat( $V , float $angle = null )
	{
		if ( ! is_object( $V ) ) $V = new Vec3f( $V );

		$M = new Matrix4f();

		if ( $angle === null )
		{
			// rotation order : YXZ
			$M->SetWithQuaternion([ $V->x , $V->y , $V->z , 0.0 ]);
		}
		else
		{
			// rotation around axis
			$V->Mult( sin( $angle * 0.5 ) );
			$M->SetWithQuaternion([ $V->x , $V->y , $V->z , cos( $angle * 0.5 ) ]);
		}

		return $M;
	}

	static public function PerspectiveMat( float $L , float $R , float $B , float $T , float $N , float $F )
	{
		$M = new Matrix4f();

		$M->c[0][0] =  2.0 * $N / ( $R - $L ) ;
		$M->c[1][1] =  2.0 * $N / ( $R - $B ) ;

		$M->c[2][0] =   ( $R + $L ) / ( $R - $L ) ;
		$M->c[2][1] =   ( $T + $B ) / ( $T - $B ) ;
		$M->c[2][2] = - ( $F + $N ) / ( $F - $N ) ;
		$M->c[2][3] = -1.0;

		$M->c[3][2] = -2.0 * $F * $N / ( $F - $N ) ;
		$M->c[3][3] =  0.0;

		return $M;
	}

	static public function OrthoMat( float $L , float $R , float $B , float $T , float $N , float $F )
	{
		$M = new Matrix4f();

		$M->c[0][0] =  2.0 / ( $R - $L ) ;
		$M->c[1][1] =  2.0 / ( $T - $B ) ;
		$M->c[2][2] = -2.0 / ( $F - $N ) ;

		$M->c[3][0] = -( $R + $L ) / ( $R - $L ) ;
		$M->c[3][1] = -( $T + $B ) / ( $T - $B ) ;
		$M->c[3][2] = -( $F + $N ) / ( $F - $N ) ;

		return $M;
	}

	static public function FastMult43( $M , $A , $B )
	{
		$M->c[0][0] = ( $A->c[0][0] * $B->c[0][0] ) + ( $A->c[1][0] * $B->c[0][1] ) + ( $A->c[2][0] * $B->c[0][2] ) ;
		$M->c[0][1] = ( $A->c[0][1] * $B->c[0][0] ) + ( $A->c[1][1] * $B->c[0][1] ) + ( $A->c[2][1] * $B->c[0][2] ) ;
		$M->c[0][2] = ( $A->c[0][2] * $B->c[0][0] ) + ( $A->c[1][2] * $B->c[0][1] ) + ( $A->c[2][2] * $B->c[0][2] ) ;
		$M->c[0][3] = 0.0 ;

		$M->c[1][0] = ( $A->c[0][0] * $B->c[1][0] ) + ( $A->c[1][0] * $B->c[1][1] ) + ( $A->c[2][0] * $B->c[1][2] ) ;
		$M->c[1][1] = ( $A->c[0][1] * $B->c[1][0] ) + ( $A->c[1][1] * $B->c[1][1] ) + ( $A->c[2][1] * $B->c[1][2] ) ;
		$M->c[1][2] = ( $A->c[0][2] * $B->c[1][0] ) + ( $A->c[1][2] * $B->c[1][1] ) + ( $A->c[2][2] * $B->c[1][2] ) ;
		$M->c[1][3] = 0.0 ;

		$M->c[2][0] = ( $A->c[0][0] * $B->c[2][0] ) + ( $A->c[1][0] * $B->c[2][1] ) + ( $A->c[2][0] * $B->c[2][2] ) ;
		$M->c[2][1] = ( $A->c[0][1] * $B->c[2][0] ) + ( $A->c[1][1] * $B->c[2][1] ) + ( $A->c[2][1] * $B->c[2][2] ) ;
		$M->c[2][2] = ( $A->c[0][2] * $B->c[2][0] ) + ( $A->c[1][2] * $B->c[2][1] ) + ( $A->c[2][2] * $B->c[2][2] ) ;
		$M->c[2][3] = 0.0 ;

		$M->c[3][0] = ( $A->c[0][0] * $B->c[3][0] ) + ( $A->c[1][0] * $B->c[3][1] ) + ( $A->c[2][0] * $B->c[3][2] ) ;
		$M->c[3][1] = ( $A->c[0][1] * $B->c[3][0] ) + ( $A->c[1][1] * $B->c[3][1] ) + ( $A->c[2][1] * $B->c[3][2] ) ;
		$M->c[3][2] = ( $A->c[0][2] * $B->c[3][0] ) + ( $A->c[1][2] * $B->c[3][1] ) + ( $A->c[2][2] * $B->c[3][2] ) ;
		$M->c[3][3] = 1.0 ; //!\ ONE
	}

	static function is_matrix( $M )
	{
		return is_object( $M ) && ( get_class( $M ) == "Matrix4f" ) ;
	}

// ----------------- INIT ----------------------------------------------------

	public function __construct( $M = null )
	{
		$this->Set( $M );
	}

	public function Set( $M = null )
	{
		if ( $M === null ) // identity matrix
		{
			for( $r = 0 ; $r < 4 ; $r++ )
			{
				for( $c = 0 ; $c < 4 ; $c ++ )
				{
					$this->c[ $r ][ $c ] = static::IDENTITY[ $r ][ $c ];
				}
			}
		}
		else
		if ( is_array( $M ) )
		{
			if ( count( $M ) <= 4 )
			{
				$this->SetWithQuaternion( $M );
			}
			else
			{
				$i = 0 ;
				for( $r = 0 ; $r < 4 ; $r++ )
				{
					for( $c = 0 ; $c < 4 ; $c ++ )
					{
						$this->c[ $r ][ $c ] = $M[ $i++ ] ;
					}
				}
			}
		}
		else
		if ( is_object( $M ) )
		{
			switch( get_class( $M ) )
			{
				case 'Matrix4f':
					for( $r = 0 ; $r < 4 ; $r++ )
					{
						for( $c = 0 ; $c < 4 ; $c ++ )
						{
							$this->c[ $r ][ $c ] = $M[ $r][ $c ];
						}
					}
				break;
				case 'Quaternion':
					$this->SetWithQuaternion( $M );
				break;
			}
		}
		else
		{
			$M = floatval( $M );
			for( $r = 0 ; $r < 4 ; $r++ )
			{
				for( $c = 0 ; $c < 4 ; $c ++ )
				{
					$this->c[ $r ][ $c ] = $M;
				}
			}
		}

		return $this;
	}

	public function SetWithQuaternion( $Q )
	{
		if ( ! is_object( $Q ) ) $Q = new Quaternion( $Q );

		// Calculate coefficients :

		$x2 = $Q->x + $Q->x ;
		$y2 = $Q->y + $Q->y ;
		$z2 = $Q->z + $Q->z ;

		$xx = $Q->x * $x2 ;
		$xy = $Q->x * $y2 ;
		$xz = $Q->x * $z2 ;

		$yy = $Q->y * $y2 ;
		$yz = $Q->y * $z2 ;
		$zz = $Q->z * $z2 ;

		$wx = $Q->w * $x2 ;
		$wy = $Q->w * $y2 ;
		$wz = $Q->w * $z2 ;

		$this->c[0][0] = 1.0 - ( $yy + $zz ) ;
		$this->c[0][1] = $xy + $wz ;
		$this->c[0][2] = $xz - $wy ;
		$this->c[0][3] = 0.0 ;

		$this->c[1][0] = $xy - $wz ;
		$this->c[1][1] = 1.0 - ( $xx + $zz ) ;
		$this->c[1][2] = $yz + $wx ;
		$this->c[1][3] = 0.0 ;

		$this->c[2][0] = $xz + $wy ;
		$this->c[2][1] = $yz - $wx ;
		$this->c[2][2] = 1.0 - ( $xx + $yy ) ;
		$this->c[2][3] = 0.0 ;

		$this->c[3][0] = 0.0 ;
		$this->c[3][1] = 0.0 ;
		$this->c[3][2] = 0.0 ;
		$this->c[3][3] = 1.0 ;

		return $this;
	}

	public function Clone()
	{
		$M = new Matrix4f( $this );
		return $M ;
	}

// ------------ MATH ------------------------------------------------------------

	public function Add( $M )
	{
		if ( ! static::is_matrix( $M ) ) $M = new Matrix4f( $M );

		for( $r = 0 ; $r < 4 ; $r++ )
		{
			for( $c = 0 ; $c < 4 ; $c ++ )
			{
				$this->c[ $r ][ $c ] += $M[ $r ][ $c ];
			}
		}

		return $this;
	}

	public function Sub( $M )
	{
		if ( ! static::is_matrix( $M ) ) $M = new Matrix4f( $M );

		for( $r = 0 ; $r < 4 ; $r++ )
		{
			for( $c = 0 ; $c < 4 ; $c ++ )
			{
				$this->c[ $r ][ $c ] -= $M[ $r ][ $c ];
			}
		}

		return $this;
	}

	public function MultFast( $B )
	{
		$M = new Matrix4f( $this );
		$A = $this;

		$M->c[0][0] = ( $A->c[0][0] * $B->c[0][0] ) + ( $A->c[1][0] * $B->c[0][1] ) + ( $A->c[2][0] * $B->c[0][2] ) ;
		$M->c[0][1] = ( $A->c[0][1] * $B->c[0][0] ) + ( $A->c[1][1] * $B->c[0][1] ) + ( $A->c[2][1] * $B->c[0][2] ) ;
		$M->c[0][2] = ( $A->c[0][2] * $B->c[0][0] ) + ( $A->c[1][2] * $B->c[0][1] ) + ( $A->c[2][2] * $B->c[0][2] ) ;
		$M->c[0][3] = 0.0 ;

		$M->c[1][0] = ( $A->c[0][0] * $B->c[1][0] ) + ( $A->c[1][0] * $B->c[1][1] ) + ( $A->c[2][0] * $B->c[1][2] ) ;
		$M->c[1][1] = ( $A->c[0][1] * $B->c[1][0] ) + ( $A->c[1][1] * $B->c[1][1] ) + ( $A->c[2][1] * $B->c[1][2] ) ;
		$M->c[1][2] = ( $A->c[0][2] * $B->c[1][0] ) + ( $A->c[1][2] * $B->c[1][1] ) + ( $A->c[2][2] * $B->c[1][2] ) ;
		$M->c[1][3] = 0.0 ;

		$M->c[2][0] = ( $A->c[0][0] * $B->c[2][0] ) + ( $A->c[1][0] * $B->c[2][1] ) + ( $A->c[2][0] * $B->c[2][2] ) ;
		$M->c[2][1] = ( $A->c[0][1] * $B->c[2][0] ) + ( $A->c[1][1] * $B->c[2][1] ) + ( $A->c[2][1] * $B->c[2][2] ) ;
		$M->c[2][2] = ( $A->c[0][2] * $B->c[2][0] ) + ( $A->c[1][2] * $B->c[2][1] ) + ( $A->c[2][2] * $B->c[2][2] ) ;
		$M->c[2][3] = 0.0 ;

		$M->c[3][0] = ( $A->c[0][0] * $B->c[3][0] ) + ( $A->c[1][0] * $B->c[3][1] ) + ( $A->c[2][0] * $B->c[3][2] ) ;
		$M->c[3][1] = ( $A->c[0][1] * $B->c[3][0] ) + ( $A->c[1][1] * $B->c[3][1] ) + ( $A->c[2][1] * $B->c[3][2] ) ;
		$M->c[3][2] = ( $A->c[0][2] * $B->c[3][0] ) + ( $A->c[1][2] * $B->c[3][1] ) + ( $A->c[2][2] * $B->c[3][2] ) ;
		$M->c[3][3] = 1.0 ; //!\ ONE

		$this->c = $M->c ;

		return $this;
	}

	public function Mult( $B )
	{
		if ( is_array( $B ) )
		{
			switch( count( $B ) )
			{
				case 3 : $B = new      Vec3f( $B ); break;
				case 4 : $B = new Quaternion( $B ); break;
				default :
					exit("Matrix4f::Mult() : array length not supported : ".print_r( $B, true ));
			}
		}

		if ( Vec3f::is_vector( $B ) )
		{
			return new Vec3f([
				( $B->x * $this->c[0][0] ) + ( $B->y * $this->c[1][0] ) + ( $B->z * $this->c[2][0] ) + $his->c[3][0] ,
				( $B->x * $this->c[0][1] ) + ( $B->y * $this->c[1][1] ) + ( $B->z * $this->c[2][1] ) + $his->c[3][1] ,
				( $B->x * $this->c[0][2] ) + ( $B->y * $this->c[1][2] ) + ( $B->z * $this->c[2][2] ) + $his->c[3][2] ,
			]);
		}
		else
		if ( Matrix4f::is_quaternion( $B ) )
		{
			exit("Matrix4f::Mult( Quaternion ) not implemented");
		}
		else
		if ( Matrix4f::is_matrix( $B ) )
		{
			$M = new Matrix4f( $this );
			$A = $this;

			$M->c[0][0] = ( $A->c[0][0] * $B->c[0][0] ) + ( $A->c[1][0] * $B->c[0][1] ) + ( $A->c[2][0] * $B->c[0][2] ) + ( $A->c[3][0] * $B->c[0][3] ) ;
			$M->c[0][1] = ( $A->c[0][1] * $B->c[0][0] ) + ( $A->c[1][1] * $B->c[0][1] ) + ( $A->c[2][1] * $B->c[0][2] ) + ( $A->c[3][1] * $B->c[0][3] ) ;
			$M->c[0][2] = ( $A->c[0][2] * $B->c[0][0] ) + ( $A->c[1][2] * $B->c[0][1] ) + ( $A->c[2][2] * $B->c[0][2] ) + ( $A->c[3][2] * $B->c[0][3] ) ;
			$M->c[0][3] = ( $A->c[0][3] * $B->c[0][0] ) + ( $A->c[1][3] * $B->c[0][1] ) + ( $A->c[2][3] * $B->c[0][2] ) + ( $A->c[3][3] * $B->c[0][3] ) ;

			$M->c[1][0] = ( $A->c[0][0] * $B->c[1][0] ) + ( $A->c[1][0] * $B->c[1][1] ) + ( $A->c[2][0] * $B->c[1][2] ) + ( $A->c[3][0] * $B->c[1][3] ) ;
			$M->c[1][1] = ( $A->c[0][1] * $B->c[1][0] ) + ( $A->c[1][1] * $B->c[1][1] ) + ( $A->c[2][1] * $B->c[1][2] ) + ( $A->c[3][1] * $B->c[1][3] ) ;
			$M->c[1][2] = ( $A->c[0][2] * $B->c[1][0] ) + ( $A->c[1][2] * $B->c[1][1] ) + ( $A->c[2][2] * $B->c[1][2] ) + ( $A->c[3][2] * $B->c[1][3] ) ;
			$M->c[1][3] = ( $A->c[0][3] * $B->c[1][0] ) + ( $A->c[1][3] * $B->c[1][1] ) + ( $A->c[2][3] * $B->c[1][2] ) + ( $A->c[3][3] * $B->c[1][3] ) ;

			$M->c[2][0] = ( $A->c[0][0] * $B->c[2][0] ) + ( $A->c[1][0] * $B->c[2][1] ) + ( $A->c[2][0] * $B->c[2][2] ) + ( $A->c[3][0] * $B->c[2][3] ) ;
			$M->c[2][1] = ( $A->c[0][1] * $B->c[2][0] ) + ( $A->c[1][1] * $B->c[2][1] ) + ( $A->c[2][1] * $B->c[2][2] ) + ( $A->c[3][1] * $B->c[2][3] ) ;
			$M->c[2][2] = ( $A->c[0][2] * $B->c[2][0] ) + ( $A->c[1][2] * $B->c[2][1] ) + ( $A->c[2][2] * $B->c[2][2] ) + ( $A->c[3][2] * $B->c[2][3] ) ;
			$M->c[2][3] = ( $A->c[0][3] * $B->c[2][0] ) + ( $A->c[1][3] * $B->c[2][1] ) + ( $A->c[2][3] * $B->c[2][2] ) + ( $A->c[3][3] * $B->c[2][3] ) ;

			$M->c[3][0] = ( $A->c[0][0] * $B->c[3][0] ) + ( $A->c[1][0] * $B->c[3][1] ) + ( $A->c[2][0] * $B->c[3][2] ) + ( $A->c[3][0] * $B->c[3][3] ) ;
			$M->c[3][1] = ( $A->c[0][1] * $B->c[3][0] ) + ( $A->c[1][1] * $B->c[3][1] ) + ( $A->c[2][1] * $B->c[3][2] ) + ( $A->c[3][1] * $B->c[3][3] ) ;
			$M->c[3][2] = ( $A->c[0][2] * $B->c[3][0] ) + ( $A->c[1][2] * $B->c[3][1] ) + ( $A->c[2][2] * $B->c[3][2] ) + ( $A->c[3][2] * $B->c[3][3] ) ;
			$M->c[3][3] = ( $A->c[0][3] * $B->c[3][0] ) + ( $A->c[1][3] * $B->c[3][1] ) + ( $A->c[2][3] * $B->c[3][2] ) + ( $A->c[3][3] * $B->c[3][3] ) ;

			$this->c = $M->c ;
		}
		else
		{
			$B = floatval( $B );

			for( $r = 0 ; $r < 4 ; $r++ )
			{
				for( $c = 0 ; $c < 4 ; $c ++ )
				{
					$this->c[ $r ][ $c ] *= $B ;
				}
			}
		}

		return $this;
	}

// -------------- TRANSFORMS ----------------------------------------------------------

	public function Translate( $V )
	{
		$this->c = static::TransMat( $V )->Mult( $this );

		return $this;
	}

	public function Scale( $V )
	{
		$this->c = static::ScaleMat( $V )->Mult( $this );

		return $this;
	}

	public function Rotate( $V )
	{
		$this->c = static::RotMat( $V )->Mult( $this );

		return $this;
	}

// --------------- COMPLICATED -----------------------------------------------------------

	public function Transpose()
	{
		for( $Y = 0 ; $Y < 4 ; $Y++ )
		{
			for( $X = 0 ; $X < 4 ; $X++ )
			{
				$tmp = $this->c[ $X ][ $Y ];

				$this->c[ $X ][ $Y ] = $this->c[ $Y ][ $X ] ;
				$this->c[ $Y ][ $X ] = $tmp ;
			}
		}

		return $this;
	}

	public function Determinant()
	{
		return 0.0
			+ $this->c[0][3]*$this->c[1][2]*$this->c[2][1]*$this->c[3][0]
			- $this->c[0][2]*$this->c[1][3]*$this->c[2][1]*$this->c[3][0]
			- $this->c[0][3]*$this->c[1][1]*$this->c[2][2]*$this->c[3][0]
			+ $this->c[0][1]*$this->c[1][3]*$this->c[2][2]*$this->c[3][0]

			+ $this->c[0][2]*$this->c[1][1]*$this->c[2][3]*$this->c[3][0]
			- $this->c[0][1]*$this->c[1][2]*$this->c[2][3]*$this->c[3][0]
			- $this->c[0][3]*$this->c[1][2]*$this->c[2][0]*$this->c[3][1]
			+ $this->c[0][2]*$this->c[1][3]*$this->c[2][0]*$this->c[3][1]

			+ $this->c[0][3]*$this->c[1][0]*$this->c[2][2]*$this->c[3][1]
			- $this->c[0][0]*$this->c[1][3]*$this->c[2][2]*$this->c[3][1]
			- $this->c[0][2]*$this->c[1][0]*$this->c[2][3]*$this->c[3][1]
			+ $this->c[0][0]*$this->c[1][2]*$this->c[2][3]*$this->c[3][1]

			+ $this->c[0][3]*$this->c[1][1]*$this->c[2][0]*$this->c[3][2]
			- $this->c[0][1]*$this->c[1][3]*$this->c[2][0]*$this->c[3][2]
			- $this->c[0][3]*$this->c[1][0]*$this->c[2][1]*$this->c[3][2]
			+ $this->c[0][0]*$this->c[1][3]*$this->c[2][1]*$this->c[3][2]

			+ $this->c[0][1]*$this->c[1][0]*$this->c[2][3]*$this->c[3][2]
			- $this->c[0][0]*$this->c[1][1]*$this->c[2][3]*$this->c[3][2]
			- $this->c[0][2]*$this->c[1][1]*$this->c[2][0]*$this->c[3][3]
			+ $this->c[0][1]*$this->c[1][2]*$this->c[2][0]*$this->c[3][3]

			+ $this->c[0][2]*$this->c[1][0]*$this->c[2][1]*$this->c[3][3]
			- $this->c[0][0]*$this->c[1][2]*$this->c[2][1]*$this->c[3][3]
			- $this->c[0][1]*$this->c[1][0]*$this->c[2][2]*$this->c[3][3]
			+ $this->c[0][0]*$this->c[1][1]*$this->c[2][2]*$this->c[3][3]
			;
	}

	public function Inverted()
	{
		$d = $this->Determinant();

		if ( $d == 0.0 ) return $this;
		$d = 1.0 / $d;

		$M = [ [] , [] , [] , [] ];

		$c = &$this->c ;

		$M[0][0] = $d * ($c[1][2]*$c[2][3]*$c[3][1] - $c[1][3]*$c[2][2]*$c[3][1] + $c[1][3]*$c[2][1]*$c[3][2] - $c[1][1]*$c[2][3]*$c[3][2] - $c[1][2]*$c[2][1]*$c[3][3] + $c[1][1]*$c[2][2]*$c[3][3]);
		$M[0][1] = $d * ($c[0][3]*$c[2][2]*$c[3][1] - $c[0][2]*$c[2][3]*$c[3][1] - $c[0][3]*$c[2][1]*$c[3][2] + $c[0][1]*$c[2][3]*$c[3][2] + $c[0][2]*$c[2][1]*$c[3][3] - $c[0][1]*$c[2][2]*$c[3][3]);
		$M[0][2] = $d * ($c[0][2]*$c[1][3]*$c[3][1] - $c[0][3]*$c[1][2]*$c[3][1] + $c[0][3]*$c[1][1]*$c[3][2] - $c[0][1]*$c[1][3]*$c[3][2] - $c[0][2]*$c[1][1]*$c[3][3] + $c[0][1]*$c[1][2]*$c[3][3]);
		$M[0][3] = $d * ($c[0][3]*$c[1][2]*$c[2][1] - $c[0][2]*$c[1][3]*$c[2][1] - $c[0][3]*$c[1][1]*$c[2][2] + $c[0][1]*$c[1][3]*$c[2][2] + $c[0][2]*$c[1][1]*$c[2][3] - $c[0][1]*$c[1][2]*$c[2][3]);
		$M[1][0] = $d * ($c[1][3]*$c[2][2]*$c[3][0] - $c[1][2]*$c[2][3]*$c[3][0] - $c[1][3]*$c[2][0]*$c[3][2] + $c[1][0]*$c[2][3]*$c[3][2] + $c[1][2]*$c[2][0]*$c[3][3] - $c[1][0]*$c[2][2]*$c[3][3]);
		$M[1][1] = $d * ($c[0][2]*$c[2][3]*$c[3][0] - $c[0][3]*$c[2][2]*$c[3][0] + $c[0][3]*$c[2][0]*$c[3][2] - $c[0][0]*$c[2][3]*$c[3][2] - $c[0][2]*$c[2][0]*$c[3][3] + $c[0][0]*$c[2][2]*$c[3][3]);
		$M[1][2] = $d * ($c[0][3]*$c[1][2]*$c[3][0] - $c[0][2]*$c[1][3]*$c[3][0] - $c[0][3]*$c[1][0]*$c[3][2] + $c[0][0]*$c[1][3]*$c[3][2] + $c[0][2]*$c[1][0]*$c[3][3] - $c[0][0]*$c[1][2]*$c[3][3]);
		$M[1][3] = $d * ($c[0][2]*$c[1][3]*$c[2][0] - $c[0][3]*$c[1][2]*$c[2][0] + $c[0][3]*$c[1][0]*$c[2][2] - $c[0][0]*$c[1][3]*$c[2][2] - $c[0][2]*$c[1][0]*$c[2][3] + $c[0][0]*$c[1][2]*$c[2][3]);
		$M[2][0] = $d * ($c[1][1]*$c[2][3]*$c[3][0] - $c[1][3]*$c[2][1]*$c[3][0] + $c[1][3]*$c[2][0]*$c[3][1] - $c[1][0]*$c[2][3]*$c[3][1] - $c[1][1]*$c[2][0]*$c[3][3] + $c[1][0]*$c[2][1]*$c[3][3]);
		$M[2][1] = $d * ($c[0][3]*$c[2][1]*$c[3][0] - $c[0][1]*$c[2][3]*$c[3][0] - $c[0][3]*$c[2][0]*$c[3][1] + $c[0][0]*$c[2][3]*$c[3][1] + $c[0][1]*$c[2][0]*$c[3][3] - $c[0][0]*$c[2][1]*$c[3][3]);
		$M[2][2] = $d * ($c[0][1]*$c[1][3]*$c[3][0] - $c[0][3]*$c[1][1]*$c[3][0] + $c[0][3]*$c[1][0]*$c[3][1] - $c[0][0]*$c[1][3]*$c[3][1] - $c[0][1]*$c[1][0]*$c[3][3] + $c[0][0]*$c[1][1]*$c[3][3]);
		$M[2][3] = $d * ($c[0][3]*$c[1][1]*$c[2][0] - $c[0][1]*$c[1][3]*$c[2][0] - $c[0][3]*$c[1][0]*$c[2][1] + $c[0][0]*$c[1][3]*$c[2][1] + $c[0][1]*$c[1][0]*$c[2][3] - $c[0][0]*$c[1][1]*$c[2][3]);
		$M[3][0] = $d * ($c[1][2]*$c[2][1]*$c[3][0] - $c[1][1]*$c[2][2]*$c[3][0] - $c[1][2]*$c[2][0]*$c[3][1] + $c[1][0]*$c[2][2]*$c[3][1] + $c[1][1]*$c[2][0]*$c[3][2] - $c[1][0]*$c[2][1]*$c[3][2]);
		$M[3][1] = $d * ($c[0][1]*$c[2][2]*$c[3][0] - $c[0][2]*$c[2][1]*$c[3][0] + $c[0][2]*$c[2][0]*$c[3][1] - $c[0][0]*$c[2][2]*$c[3][1] - $c[0][1]*$c[2][0]*$c[3][2] + $c[0][0]*$c[2][1]*$c[3][2]);
		$M[3][2] = $d * ($c[0][2]*$c[1][1]*$c[3][0] - $c[0][1]*$c[1][2]*$c[3][0] - $c[0][2]*$c[1][0]*$c[3][1] + $c[0][0]*$c[1][2]*$c[3][1] + $c[0][1]*$c[1][0]*$c[3][2] - $c[0][0]*$c[1][1]*$c[3][2]);
		$M[3][3] = $d * ($c[0][1]*$c[1][2]*$c[2][0] - $c[0][2]*$c[1][1]*$c[2][0] + $c[0][2]*$c[1][0]*$c[2][1] - $c[0][0]*$c[1][2]*$c[2][1] - $c[0][1]*$c[1][0]*$c[2][2] + $c[0][0]*$c[1][1]*$c[2][2]);

		$this->c = $M ;

		return $this;
	}

	public function Decompose()
	{
		$trans = new Vec3f( $this->c[3] );

		// Scale is the length of columns

		$scale = new Vec3f([
			sqrt( $this->c[0][0]**2 + $this->c[0][1]**2 + $this->c[0][2]**2 ) ,
			sqrt( $this->c[1][0]**2 + $this->c[1][1]**2 + $this->c[1][2]**2 ) ,
			sqrt( $this->c[2][0]**2 + $this->c[2][1]**2 + $this->c[2][2]**2 ) ,
		]);

		if ( $scale->x == 0.0 || $scale->y == 0.0 || $scale->z == 0.0 ) return false ;

		// Detect negative scale with determinant and flip one arbitrary axis :

		if ( $this->Determinant() < 0.0 ) $scale->x = -$scale->x ;

		// Combined rotation matrix XYZ :

		$rot = new Vec3f();

		$rot->x = asin( - $this->c[2][1] / $scale->z ) ;

		// Special case : cos(x) == 0.0 when sin(x) is +/- 1.0 :

		$f = abs( $this->c[2][1] / $scale->z ) ;

		if ( $f > 0.999 && $f < 1.001 )
		{
			// Pin arbitrarily one of y or z to zero
			// Mathematical equivalent of gimbla lock

			$rot->y = 0.0 ;

			// Now : cos(x) = 0.0 ; sin(x) = +/- 1.0 ; cos(y) = 1.0 ; sin(y) = 0.0
			// => m[0][0] = cos(z) and m[1][0] = sin(z)

			$rot->z = atan2( - $this->c[1][0] / $scale->y , $this->c[0][0] / $scale->x ) ;
		}
		else
		{
			// Standard case :

			$rot->y = atan2( $this->c[2][0] / $scale->z , $this->c[2][2] / $scale->z );
			$rot->z = atan2( $this->c[0][1] / $scale->x , $this->c[1][1] / $scale->y );
		}

		return [ $trans , $rot , $scale ] ;
	}

// --------------- HELPERS -------------------------------

	public function setCol( int $col , $V )
	{
		if ( Vec3f::is_vector( $V ) )
		{
			$V = $V->toArray();
		}

		for( $i = 0 ; $i<4 ; $i++ )
		{
			$this->c[ $col ][ $i ] = $V[ $i ] ?? 1.0 ;
		}

		return $this;
	}

	public function getcol( int $col )
	{
		return $this->c[ $col ];
	}

	public function getRow( int $row )
	{
		return [ $this->c[0][ $row ] , $this->c[1][ $row ] , $this->c[2][ $row ] , $this->c[3][ $row ] ];
	}

	public function getTrans()
	{
		return new Vec3f( $this->c[3] );
	}

	public function getScale()
	{
		return new Vec3f([
			sqrt( $this->c[0][0]**2 + $this->c[0][1]**2 + $this->c[0][2]**2 ) ,
			sqrt( $this->c[1][0]**2 + $this->c[1][1]**2 + $this->c[1][2]**2 ) ,
			sqrt( $this->c[2][0]**2 + $this->c[2][1]**2 + $this->c[2][2]**2 ) ,
		]);
	}
}

//===========================================================
// Plane
//===========================================================

class Plane
{
	public $normal; // Vec3f
	public float $dist;

// ----------------- INIT -----------------------------

	function __construct( $V , float $d = null )
	{
		$this->Set( $V , $d );
	}

	public function Set( $V , float $d = null )
	{
		// Possible parameters cases :
			// $V = [ a , b , c ] , d
			// $V = [ a , b , c , d ]
			// $V = Vec3f
			// $V = [ Vec3f , Vec3f , Vec3f ]
			// $V = [ [ v0 ] , [ v1 ] , [ v2 ] ]

		if ( is_array( $V ) )
		{
			if ( is_array( $V[0] ) )
			{
				// Case where $V = [ [ v0 ] , [ v1 ] , [ v2 ] ]

				for( $i = 0 ; $i<3 ; $i++ )
				{
					$V[ $i ] = new Vec3f( $V[ $i ] );
				}

				// falldown ↓↓↓
			}

			if ( Vec3f::is_vector( $V[0] ) )
			{
				// Case where $V = [ Vec3f , Vec3f , Vec3f ]

				$this->normal = $V[1]->Clone()->Sub( $V[0] );
				$this->normal = $this->normal->Cross( $V[2]->Clone()->Sub( $V[0] ) );
				$this->normal->Normalise();

				$this->dist = - $this->normal->Dot( $V[0] );

				return $this;
			}

			// Case where $V = [ a , b , c ]
			// Case where $V = [ a , b , c , d ]

			$d ??= floatval( $V[3] ?? 0.0 ) ; // if $d unspecified, try $V[d] or default to 0.0

			// falldown ↓↓↓
		}

		// Case where $V = [ a , b , c ]
		// Case where $V = [ a , b , c , d ]
		// Case where $V = Vec3f

		$this->normal = new Vec3f( $V );

		$invLen = 1.0 / $this->normal->Len() ;

		$this->normal->Mult( $invLen ); // normalize the normal

		$this->dist = $d * $invLen ;

		return $this;
	}

// ---------- MATH -------------------------------------------

	public function Distance( $V )
	{
		return $this->normal->Dot( $V ) + $this->dist ;
	}
}


//==============================================================================
// Intersections :
//==============================================================================

class Intersection
{

// ------- CONST ---------------------------------------

	const EPSILON = 0.000001;

// --------STATIC METHODS --------------------------------------

	static public function RayTriangle( $ray_origin , $ray_dir , $V0 , $V1 , $V2 )
	{
		$ray_origin = Vec3f::cast( $ray_origin );
		$ray_dir    = Vec3f::cast( $ray_dir    );

		$V0 = Vec3f::cast( $V0 );
		$V1 = Vec3f::cast( $V1 );
		$V2 = Vec3f::cast( $V2 );

		// Directly ported from Horde3D to PHP :

		// Idea: Tomas Moeller and Ben Trumbore
		// in Fast, Minimum Storage Ray/Triangle Intersection

		// Find vectors for 2 edges sharing V0 :

		$edge1 = $V1->Clone()->Sub( $V0 );
		$edge2 = $V2->Clone()->Sub( $V0 );

		// Begin calculating determinant - also used to calculte U parameter :

		$pvec = $ray_dir->Cross( $edge1 );

		// If determinant is near zero, ray lies in plane of triangle :

		$det = $edge1->Dot( $pvec );

		if ( ( $det > -static::EPSILON ) && ( $det < static::EPSILON ) ) return false ;

		$inv_det = 1.0 / $det ;

		// Calculate distance from V0 to ray_origin :

		$tvec = $ray_origin->Clone()->Sub( $V0 );

		// Calculate U parameter and test bounds :

		$u = $tvec->Dot( $pvec ) * $inv_det ;

		if ( $u < 0.0 || $u > 1.0 ) return false ;

		// Prepare to test V parameter :

		$qvec = $tvec->Cross( $edge1 );

		// Calculate V parameter and test bounds :

		$v = $ray_dir->Dot( $qvec ) * $inv_det ;

		if ( $v < 0.0 || ( $u + $v ) > 1.0 ) return false ;

		// Calculate t, ray intersects triangle :

		$t = $edge2->Dot( $qvec ) * $inv_det ;


		// Calculate inersection point and test ray length and direction :

		$instPoint = $ray_origin->Clone()->Add( $ray_dir )->Mult( $t );

		$vec = $instPoint->Sub( $ray_origin );

		if ( ( $vec->dot( $ray_dir ) < 0.0 ) ||	( $vec->Len() > $ray_dir->Len() ) ) return false ;

		return true;
	}

	static public function RayAABB( $ray_origin , $ray_dir , $aabb_mins , $aabb_maxs )
	{
		$ray_origin = Vec3f::cast( $ray_origin );
		$ray_dir    = Vec3f::cast( $ray_dir    );
		$aabb_mins  = Vec3f::cast( $aabb_mins  );
		$aabb_maxs  = Vec3f::cast( $aabb_maxs  );

		// SLAB based optimized ray/AABB intersection routine
		// Idea taken from http://ompf.org/ray/

		$l1 = ( $aabb_mins->x - $ray_origin->x ) / $ray_dir->x ;
		$l2 = ( $aabb_maxs->x - $ray_origin->x ) / $ray_dir->x ;

		$lmin = min( $l1 , $l2 );
		$lmax = max( $l1 , $l2 );

		$l1 = ( $aabb_mins->y - $ray_origin->y ) / $ray_dir->y ;
		$l2 = ( $aabb_maxs->y - $ray_origin->y ) / $ray_dir->y ;

		$lmin = max( min( $l1 , $l2 ), $lmin );
		$lmax = min( max( $l1 , $l2 ), $lmax );

		$l1 = ( $aabb_mins->z - $ray_origin->z ) / $ray_dir->z ;
		$l2 = ( $aabb_maxs->z - $ray_origin->z ) / $ray_dir->z ;

		$lmin = max( min( $l1 , $l2 ), $lmin );
		$lmax = min( max( $l1 , $l2 ), $lmax );


		if ( ( $lmax >= 0.0 ) && ( $lmax >= $lmin ) )
		{
			// Consider length :

			$ray_dest = $ray_origin->Clone()->Add( $ray_dir );

			$ray_mins = [
				min( $ray_dest->x , $ray_origin->x ) ,
				min( $ray_dest->y , $ray_origin->y ) ,
				min( $ray_dest->z , $ray_origin->z ) ,
			];

			$ray_maxs = [
				max( $ray_dest->x , $ray_origin->x ) ,
				max( $ray_dest->y , $ray_origin->y ) ,
				max( $ray_dest->z , $ray_origin->z ) ,
			];

			return
				( $ray_mins->x < $aabb_maxs->x ) && ( $ray_maxs->x > $aabb_mins->x )
				&&
				( $ray_mins->y < $aabb_maxs->y ) && ( $ray_maxs->y > $aabb_mins->y )
				&&
				( $ray_mins->z < $aabb_maxs->z ) && ( $ray_maxs->z > $aabb_mins->z )
				;
		}

		return false;
	}
}
