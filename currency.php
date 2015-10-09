<?php

namespace App\Helpers;

class Currency
{	
	protected static $amount = 0,
					 $decimalPlaces = 2,
					 $decimalSeparator = ",",
					 $thousandSeparator = ".",
					 $prefix = null,
					 $suffix = null;
			
	public static function amount($amount)
	{
		static::$amount = $amount;
		
		return new static;
	}
	
	public static function decimalPlaces($int)
	{
		static::$decimalPlaces = $int;
		
		return new static;
	}
	
	public static function decimalSeparator($word)
	{
		static::$decimalSeparator = $word;
		
		return new static;
	}
	
	public static function thousandSeparator($word)
	{
		static::$thousandSeparator = $word;
		
		return new static;
	}
		
	public static function prefix($word)
	{
		static::$prefix = $word;
		
		return new static;
	}
	
	public static function suffix($word)
	{
		static::$suffix = $word;
		
		return new static;
	}
	
	public static function format($options=null)
	{

		if(!empty($options))
		{
			foreach($options as $option => $val)
			{
				if(!method_exists(new static,$option)) continue;
				
				static::$option($val);
			}
		}

		
	
		$amount = static::$amount;	
		$decimalPlaces = static::$decimalPlaces;
		$decimalSeparator = static::$decimalSeparator;
		$thousandSeparator = static::$thousandSeparator;
		$prefix = static::$prefix;
		$suffix = static::$suffix;
		
		$val = number_format($amount,$decimalPlaces,$decimalSeparator,$thousandSeparator);
		
		if(!empty($prefix))
		{
			$val = $prefix." ".$val;
		}
		
		if(!empty($suffix))
		{
			$val = $val." ".$suffix;
		}
		
		return $val;
	}
	
	public static function get($var)
	{
		return static::${$var};
	}
	
	public static function toString()
	{
		return static::format();
	}
	
	public static function display()
	{
		return static::toString();
	}
	
	public static function revert()
	{
		static::$amount = 0;	
		static::$decimalPlaces = 2;
		static::$decimalSeparator = ",";
		static::$thousandSeparator = ".";
		static::$prefix = null;
		static::$suffix = null;
	}
	
	public static function clean()
	{
		static::revert();
	}
	
	public static function flush()
	{
		$display = static::display();
		static::clean();
		
		return $display;
	}
	
}
