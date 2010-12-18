<?php

namespace Bundle\DbRoutingBundle\Routing\Loader;

use Doctrine\ORM\EntityManager,
    Symfony\Component\Routing\RouteCollection,
    Symfony\Component\Routing\Route,
    Symfony\Component\Routing\Loader\Loader;

/*
 * This file is made by Leon
 *
 * (c) Leon van der Ree <leon@fun4me.demon.nl>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE of Symfony2.
 */

/**
 * DbLoader loads routes from a Database.
 * 
 * You can configure the table name in your routing.yml. E.G.
 * 
 * pages:
 *     resource: CmsBundle:Page
 *     type: db
 *   
 * this table should implement the function that are mentioned in the PageInterface
 *
 *
 * @author Leon van der Ree <leon@fun4me.demon.nl>
 */
class DbLoader extends Loader
{
    /**
     * 
     * @var \Doctrine\ORM\EntityManager
     */
    protected $em;

    /**
     * Constructor.
     *
     * @param \Doctrine\ORM\EntityManager $em the Doctrine Entity Manager
     */
    public function __construct(\Doctrine\ORM\EntityManager $em)
    {
        $this->em = $em;
    }	
    
    /**
     * Loads from the database
     *
     * @param string $table    The table that contains the pages (with title, slug and controller, configure this as resource in your routing.yml, provide as type: db )
     * @param string $type     The resource type
     * @return RouteCollection the collection of routes stored in the database table
     */
    public function load($table, $type = null)
    {
        $collection = new RouteCollection();;

        $pages = $this->em->createQuery('SELECT p FROM '.$table.' p')->execute();
	      foreach ($pages as $page)
	      {
		        $collection->add('Cms'.$page->getTitle(), new Route($page->getSlug(), array(
		            '_controller' => $page->getController(),
    		        'pageId'      => $page->getId(),
		        )));
	      }
        
        return $collection;
    }

    /**
     * Returns true if this class supports the given type (db).
     *
     * @param mixed  $resource the name of a table with title and slug field 
     * @param string $type     The resource type (db)
     *
     * @return boolean True if this class supports the given type (db), false otherwise
     */
    public function supports($resource, $type = null)
    {
        return 'db' === $type;
    }
}
