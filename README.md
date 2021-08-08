# Horde3D-php-ffi
[Horde3D 2.0](http://www.horde3d.org/) binding to PHP using FFI.

This binding can be used with [SDL2-php-ffi]( https://github.com/SuperUserNameMan/SDL2-php-ffi ).

Tested with PHP-cli 8.0.x under Linux.

This binding reuses and tries to improve the encapsulating method from [oratoto/raylib-php-ffi](https://github.com/oraoto/raylib-php-ffi) applied to the Horde3D C API :

- the Horde3D C API is encapsulated into a PHP class `Horde3D` which only contains `const` and `static` members ;
- a `__callStatic()` method is used to call C functions using FFI. Example : `` Horde3D::GetVersionString(); `` ;
- if required, it is possible to override a C function by adding a ` public static function ` with the same name into the class. This can be used to simply the C API and the usage of FFI with some functions that requires pointers.
- for now, all Horde3D's C `struct { enum {} }` are converted into PHP as individual classes containing `const`. Example : ` H3DRenderDevice::OpenGL4 ` ... (this is because some enums share identical names with different values, so they had to be kept seperated into individual classes)


## How to use :

See ` test_Horde3D.php `.

## TODO :

- [ ] port to Windows
- [ ] port other Horde3DUtils functions to PHP ?
- [ ] try to put all enums into a single Horde3D container ?
- [ ] port the Horde3D C++ framework to PHP ?


## Credits :

- the `data` folder contains files from [horde3d/Horde3D](https://github.com/horde3d/Horde3D)
