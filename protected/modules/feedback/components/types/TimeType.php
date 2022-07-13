<?php
/**
 * Time type
 *
 */
namespace feedback\components\types;

class TimeType extends BaseType
{
	/**
	 * (non-PHPdoc)
	 * @see \feedback\components\types\BaseType::rules()
	 */
	public function rules()
	{
		return \CMap::mergeArray(parent::rules(), array(
			array($this->_name, 'match', 'pattern'=>'/\d{2}:\d{2}(:\d{2})?/'),
		));
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \feedback\components\types\BaseType::getSqlColumnDefinition()
	 */
	public function getSqlColumnDefinition()
	{
		return '`' . $this->_name . '` TIME COMMENT "' . $this->_label . '"';
	}	
	
	/**
	 * (non-PHPdoc)
	 * @see \feedback\components\types\BaseType::normalize()
	 */
	public function normalize($value)
	{
		return $value;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \feedback\components\types\BaseType::format()
	 */
	public function format($value)
	{
		if(preg_match('/^(?P<hour>\d{2}):(?P<min>\d{2}):(?P<sec>\d{2})$/', $value, $date)) {
			if(!(int)$date['hour'] && !(int)$date['min'] && !(int)$date['sec']) {
				$value = null;
			}
			else {
				$value = "{$date['hour']}:{$date['min']}" . ((int)$date['sec'] ? ":{$date['sec']}" : '');
			}
		}
		return $value;
	}
}