<?php
/**
 * Fuel is a fast, lightweight, community driven PHP 5.4+ framework.
 *
 * @package    Fuel
 * @version    1.9-dev
 * @author     Fuel Development Team
 * @license    MIT License
 * @copyright  2010 - 2019 Fuel Development Team
 * @link       https://fuelphp.com
 */

/**
 * The system Controller.
 *
 *
 * @package  app
 * @extends  Controller
 */
class Controller_System extends Controller
{
	/**
	 * 
	 *
	 * @access  public
	 * @return  Response
	 */
	public function action_authority()
	{
		
	}

	/**
	 *
	 * @access  public
	 * @return  Response
	 */
	public function action_back()
	{
		
	}

	/**
	 * The 404 action for the application.
	 *
	 * @access  public
	 * @return  Response
	 */
	public function action_404()
	{
		return Response::forge(Presenter::forge('welcome/404'), 404);
	}
}
