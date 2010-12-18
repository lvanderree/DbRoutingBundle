 
 Adds the ability to retrieve routes from a database table

## Features

- Page Model is extensible 
- Requires Doctrine ORM

## Installation

### Add DbRoutingBundle to your src/Bundle dir

    git submodule add git://github.com/lvanderree/DbRoutingBundle.git src/Bundle/DbRoutingBundle

### Add DbRoutingBundle to your application kernel

    // app/AppKernel.php
    public function registerBundles()
    {
        return array(
            // ...
            new Bundle\DbRoutingBundle\DbRoutingBundle(),
            // ...
        );
    }
    
### Load the DbRouting service by including the service container configuration in your config
    
    # app/config/config.yml
    # ...
    imports:
        - { resource: DbRoutingBundle/Resources/config/routing.xml }


### and add the tableName to your routing.yml
    
    # app/config/routing.yml
    # ...
    pages:
        resource: CmsBundle:Page
        type: db
     
    

### Create your own classes

You must create a Page class, that at least implements the methods mentioned in the PageInterface 
