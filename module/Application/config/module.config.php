<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

return array(
    'router' => array(
        'routes' => array(
            'home' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Index',
                        'action'     => 'index',
                    ),
                ),
            ),
            // The following is a route to simplify getting started creating
            // new controllers and actions without needing to create a new
            // module. Simply drop new controllers in, and you can access them
            // using the path /application/:controller/:action
            'application' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/application',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller'    => 'Index',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:controller[/:action]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
    'service_manager' => array(
        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
        ),
        'aliases' => array(
            'translator' => 'MvcTranslator',
        ),
    ),
    'translator' => array(
        'locale' => 'fr_FR',
        'translation_file_patterns' => array(
            array(
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo',
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Application\Controller\Index' => 'Application\Controller\IndexController'
        ),
        'initializers' => array(
            'em' => function ($instance, $serviceLocator) {
                if ($instance instanceof \Application\Initializer\EntityManagerAware) {
                    $instance->setEm(
                        $serviceLocator->getServiceLocator()->get('doctrine.entitymanager.orm_default')
                    );
                }
            },
            'es' => function ($instance, $serviceLocator) {
                if ($instance instanceof \Application\Initializer\ElasticsearchAware) {
                    $instance->setEs(
                        $serviceLocator->getServiceLocator()->get('elasticsearch')
                    );
                }
            },
        )
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    // Placeholder for console routes
    'console' => array(
        'router' => array(
            'routes' => array(
            ),
        ),
    ),
    'doctrine' => array(
        'connection' => array(
            'orm_default' => array(
                'driverClass' => 'Doctrine\DBAL\Driver\PDOMySql\Driver',
                'params' => array(
                    'port'     => '3306',
                    'charset'  => 'UTF8'
                )
            )
        ),
        'eventmanager' => array(
            'orm_default' => array(
                'subscribers' => array(
                    // pick any listeners you need
                    'Gedmo\Timestampable\TimestampableListener',
                    // 'Gedmo\SoftDeleteable\SoftDeleteableListener',
                    // 'Gedmo\Translatable\TranslatableListener',
                    // 'Gedmo\Blameable\BlameableListener',
                    // 'Gedmo\Loggable\LoggableListener',
                    // 'Gedmo\Sluggable\SluggableListener',
                    // 'Gedmo\Sortable\SortableListener',
                    // 'Gedmo\Tree\TreeListener',
                )
            )
        ),
        /* 'driver' => array(
            'my_annotation_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/Application/Entity')
            ),
            'orm_default' => array(
                'drivers' => array(
                     'Application\Entity' => 'my_annotation_driver'
                )
            )
        ), */
        'migrations' => array(
            'migrations_table' => 'migrations',
            'migrations_namespace' => 'Application',
            'migrations_directory' => 'data/migrations',
        ),
        'fixture' => array(
            'Application_fixture' => __DIR__ . '/../src/Application/Fixture',
        ),
    ),
    
    'view_helpers' => array(
    		'invokables'=> array(
    				'alertmessages_helper' => 'Application\View\Helper\AlertmessagesHelper',
    				'titrepage_helper' => 'Application\View\Helper\TitrepageHelper',
    				'labeltypeuser_helper' => 'Application\View\Helper\LabeltypeuserHelper',
    				'labelstatutuser_helper' => 'Application\View\Helper\LabelstatutuserHelper',
    				'getauthentification_helper' => 'Application\View\Helper\GetauthentificationHelper',
    				'labeletablissement_helper' => 'Application\View\Helper\LabeletablissementHelper',
    				'labelpui_helper' => 'Application\View\Helper\LabelpuiHelper',
    				'labelmois_helper' => 'Application\View\Helper\LabelmoisHelper',
    				'exporthtmltabletoexcel_helper' => 'Application\View\Helper\ExporthtmltabletoexcelHelper',
    				'exportpdf_helper' => 'Application\View\Helper\ExportpdfHelper',
    		),
    ),
    //......
);
