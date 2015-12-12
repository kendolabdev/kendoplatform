## Improve Performance

+ Instead of loading namespace for every module, we need to group in bundle.
+ Instead of boot every module, should provide a hook ways to init routings.
+ Routing should cache all *"Route"* as states, reduce compiling time.

## Refactor
+ Instead of using ServiceManager=> App\ServiceContainer

