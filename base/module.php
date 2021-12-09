<?php
namespace ZeusElementor\Base;

use Elementor\Plugin;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Module
 *
 * Base
 *
 * @since 1.0.0
 */
abstract class Module_Base {

	/**
	 * @var \ReflectionClass
	 */
	private $reflection;

	/**
	 * @var Module_Base
	 */
	protected static $instances = [];

	/**
	 * Abstract method for retrieveing the module name.
	 *
	 * @access public
	 * @since 1.0.0
	 */
	abstract public function get_name();

	/**
	 * Return the current module class name.
	 *
	 * @access public
	 * @since 1.0.0
	 *
	 * @eturn string
	 */
	public static function class_name() {
		return get_called_class();
	}

	/**
	 * @since 1.0.0
	 * @access public
	 */
	public function get_reflection() {
		if ( null === $this->reflection ) {
			$this->reflection = new \ReflectionClass( $this );
		}

		return $this->reflection;
	}

	/**
	 * @return static
	 */
	public static function instance() {
		$class_name = static::class_name();

		if ( empty( static::$instances[ $class_name ] ) ) {
			static::$instances[ $class_name ] = new static();
		}

		return static::$instances[ $class_name ];
	}

	/**
	 * Constructor
	 *
	 * Hook into Elementor to register the widgets.
	 *
	 * @access public
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function __construct() {
		$this->reflection = new \ReflectionClass( $this );

		add_action( 'elementor/widgets/widgets_registered', [ $this, 'init_widgets' ] );
	}

	/**
	 * Initializes all widget for the current module.
	 *
	 * @access public
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function init_widgets() {
		$widget_manager = Plugin::instance()->widgets_manager;

		foreach ( $this->get_widgets() as $widget ) {
			$class_name = $this->get_reflection()->getNamespaceName() . '\Widgets\\' . $widget;

			$widget_manager->register_widget_type( new $class_name() );
		}
	}

	/**
	 * Method for retrieveing this module's widgets.
	 *
	 * @access public
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function get_widgets() {
		return [];
	}
}
