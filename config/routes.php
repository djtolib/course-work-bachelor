<?php
return array
(
    
    "/news/([a-z]+)/([0-9]+)"=>"news/view/$1/$2",
    "/news" => "news/index", //actionIndex? NewsController
    "/products" => "products/list", //
    "/user/cabinet"=>"user/cabinet",
    "/user/login"=>"user/login",
    "/user/logout"=>"user/logout",
    "/user/tolatin"=>"user/tolatin",
    "/user/transfer"=>"user/transfer",
    "/user/snyatie"=>"user/snyatie",
    "/user/derzh"=>"user/derzh",
    "/user/vipiska"=>"user/vipiska",
    "/user/calc"=>"user/calc",
    "/user/cash"=>"user/cash",
    "/user/givec"=>"user/givec",
    "/user/smsreg"=>"user/smsreg",
    "/user/perevodi"=>"user/perevodi",
    "/user/bank"=>"user/bank",
    "/user/reptran"=>"user/reptran",
    "/user/million"=>"user/million",
    "/user/livesr"=>"user/livesr", 
    "/user/fees"=>"user/fees",
    "/user/repcards"=>"user/repcards", 
    "/user/tsp"=>"user/tsp",
    "/user/transfers"=>"user/transfers",
    "/user/oldcards"=>"user/oldcards", 
    "/user/hot"=>"user/hot",
    "/user/atms"=>"user/atms",
    "/user/holdersms"=>"user/holdersms",
     "/user/edit"=>"user/edit",
     "/user/holder"=>"user/holder",
     "/user/admin"=>"user/admin",
     "user/operator/regis" =>"user/register",
     "/user/operator"=>"user/operator",
     
    "/" =>"user/login" 
);
