<?php
use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
        	new ASF\CoreBundle\ASFCoreBundle(),
        	new ASF\LayoutBundle\ASFLayoutBundle()
        );

        if (in_array($this->getEnvironment(), array('dev', 'test'))) {
            
        }

        return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__.'/config/config_'.$this->getEnvironment().'.yml');
    }
    
    public function getRootDir()
    {
    	return __DIR__;
    }
    
    public function getCacheDir()
    {
    	return __DIR__.'/cache/'.$this->getEnvironment();
    }
    
    public function getLogDir()
    {
    	return __DIR__.'/logs';
    }
}