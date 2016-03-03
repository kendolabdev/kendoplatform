## Improve Performance

+ Instead of loading namespace for every module, we need to group in bundle.
+ Instead of boot every module, should provide a hook ways to init routings.
+ Routing should cache all *"Route"* as states, reduce compiling time.

## Refactor
+ Instead of using ServiceManager=> App\ServiceContainer

routing->addRoute(profile,[
    domain: "",
    uri:     "<profilename>/*",
    defaults: {},
    filter: how to filter this touch.
])->addChild('event',[
    'uri'=>'<profile>/events',
])->addChild('groups',{
    'uri'=>'<profile>/groups',
    defaults: [],
});

//
routing->getUrl('profile_event', "sentalated the id but not moment");