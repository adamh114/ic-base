


# These should be run upon deployment
./vendor/bin/doctrine-module --documentmanager=ic_billing odm:generate:hydrators
./vendor/bin/doctrine-module --documentmanager=ic_billing odm:generate:proxies