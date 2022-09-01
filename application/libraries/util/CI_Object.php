<?php

class CI_Object{
   
   	/**
	 *
	 * Permite que libraries acessem propriedades e métodos do CI.
	 *
	 * @param string $key
	 */
	public function __get($key) {
		return get_instance()->$key;
   }
   
}