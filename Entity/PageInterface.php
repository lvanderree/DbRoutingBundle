<?php
namespace Bundle\DbRoutingBundle\Entity;

/*
 * (c) Leon van der Ree <leon@fun4me.demon.nl>
 *
 * This source file is subject to the MIT license that is bundled with Symfony2 
 */

/**
 * PageInterface is the interface that page-entities from the database should implement 
 *
 * @author Leon van der Ree <leon@fun4me.demon.nl>
 */
interface PageInterface
{
	public function getTitle();
	
	public function getSlug();
	
	public function getController();
	
}
