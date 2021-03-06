# Horde3D-php-ffi
[Horde3D 2.0](http://www.horde3d.org/) binding to PHP using FFI.

This binding can be used with [SDL2-php-ffi]( https://github.com/SuperUserNameMan/SDL2-php-ffi ).

Tested with PHP-cli 8.0.x under Linux.

- the Horde3D C API is encapsulated into a PHP class `Horde3D` which only contains `const` and `static` members ;
- it is autoinit uppon ` include_once("./include/Horde3D.php"); ` ;
- the `libHorde3D.so` or `libHorde3D.dll` will be loaded from `./lib/` or from the subdirectory defined in `FFI_LIB_DIR` ;
- a `__callStatic()` method is used to call C functions using FFI. Example : `` Horde3D::GetVersionString(); `` ;
- if required, it is possible to override a C function by adding a ` public static function ` with the same name into the class. This can be used to simply the C API and the usage of FFI with some functions that requires pointers.
- for now, all Horde3D's C `struct { enum {} }` are converted into PHP as individual classes containing `const`. Example : ` H3DRenderDevice::OpenGL4 ` ... (this is because some enums share identical names with different values, so they had to be kept seperated into individual classes)

It is made compatible with this [cglm-php-ffi](https://github.com/SuperUserNameMan/cglm-php-ffi) math library.

## How to use :

See ` test_Horde3D.php `.

## Note regarding performance :

- my experience shown that the encapsulation technic based uppon `__staticClass()` gives low performances with PHP8.0.8 when accessing FFI C-API, this even if PHP-JIT is enabled.
- for maximum best top notch super ultra giga performance, it is prefered to call the FFI C-API at the lowest level using ` Horde3D::$ffi->h3d....(...) `. 

## TODO :

- [X] port to Windows
- [ ] port other Horde3DUtils functions to PHP ?
- [ ] try to put all enums into a single Horde3D container ?
- [ ] port the Horde3D C++ framework to PHP ?


## Credits :

- the `data` folder contains files from [horde3d/Horde3D](https://github.com/horde3d/Horde3D)
