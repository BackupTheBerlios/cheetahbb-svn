<?php

/**
 * This is the template compiler class. It uses the template file and a language file to create a
 * compiled template that is much faster to handle than the uncompiled template file.
 *
 * LICENSE: This program is free software. You can redistribute it and/or modify it under the terms
 * of the GNU General Public License version 2 as published by the Free Software Foundation.
 *
 * @author     David Triendl <david@triendl.name>
 * @date       $Date$
 * @copyright  2006.2007 David Triendl
 * @package    CheetahBB
 * @subPackage COTS (CheetahBB's Own Template Engine)
 * @license    http://www.fsf.org/licensing/licenses/gpl.html  GNU General Public License 2
 */

class TemplateCompiler() {
	
	private $config;
	private $template; // This variable contains the uncompiled template
	private $compiled_template; // Stores the compiled template
	private $position; // This variable holds the actual character number. Starts with 0.
	private $line; // This variable holds the actual line number. Starts with 1. Only important for the ErrorHandler
	
	
	public function __construct($config) {
		$this->config = $config;
		global $cots_modifier_list
		$this->modifier_list = $cots_modifier_list;
	}
	
	public function compile_template($file) {
		$this->compiled_template = array(
			array(
				'compiler_version' => COTS_COMPILER_VERSION,
				'direcotry' => $this->config['template_directory'],
				'file' => $this->config['template_direcotry'] . '/' . $file . '.tpl'
			),
			array(),
			''
		);
		$this->template = file_get_contents($file) or ErrorHandler::trigger(ER_DATA + ER_HALT, __FILE__, __LINE__, 'Could not read template ' $file);
		// Guess line-feeds TODO
		$this->config['linefeed'] = "\r";
		$this->line = 1;
		$this->walk();
		return $this->compiled_template;
	}
	
	private function walk() {
		$template_length = strlen($this->template);
		for($this->position = 0; $this->position < $template_length; ++$this->position) {
			if($this->template{$postion} == '{') {
				++$this->position;
				if($this->template{$this->position} == '$') { // Variable
					$this->parse_varia
				}
			} elseif($this->template{$position} == '\\') {
				$position++;
				if($position < $template && in_array($this->template($position), array('{', '\\'}))) {
					$this->compiled_template[2] .= $this->template($position);
					continue;
				} else {
					ErrorHandler::trigger(ER_WARNING, $this->config['file'], $this->line, 'Escapce character without character to escape');
				}
			} else {
				$this->compiled_template[2] .= $this->template{$this->position};
				if($this->template{$this->position} == $config['linefeed']{0} && ($this->linefeed != "\r\n" || $this->template{$this->position + 1} == "\n")) {
					++$this->line;
				}
			}
		}
	}
	
	private function parse_variable() {
		++$this->position;
		$end_of_variable = strpos($this->template, '}', $this->position);
		if($end_of_variable === false) {
			ErrorHandler::trigger(ER_HALT, $this->config['file'], $this->line, 'No closing brace for opening brace');
		}
		$variable_modifiers = array();
		$variable_with_modifiers = substr($this->template. $this->position, $end_of_variable);
		while(false !== ($pipe = strpos($variable_with_modifiers, '}'))) {
			if(isset($variable_pure)) {
				$modifier = substr($variable_with_modifiers, 0, $pipe);
			} else {
				$variable_pure = substr($variable_with_modifiers, 0, $pipe);
		}
		#$variable = substr($this->template. $this->position, $end_of_variable);
		if(preg_match(COTS_PREG_VARIABLE)) {
			ErrorHandler::trigger(ER_HALT, $this->config['file'], $this->line, 'Bad name "$' . $variable . '" for variable';
		}
		unset($variable, $end_of_variable);
	}
	
	private function ignore_whitespace() {
		while(in_array($this->template{$this->position}), array(' ', "\t", "\n", "\r")) {
			++$this->position;
			if($this->template{$this->position} == $config['linefeed']{0} && ($this->linefeed != "\r\n" || $this->template{$this->position + 1} == "\n")) {
				++$this->line;
			}
		}
	}
	
}

?>