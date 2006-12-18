<?php

/**
 * This is the template compiler class. It uses the template file and a language file to create a
 * compiled template that is much faster to handle than the uncompiled template file.
 *
 * LICENSE: This program is free software. You can redistribute it and/or
 * modify it under the terms of the GNU General Public License version 2
 * as published by the Free Software Foundation.
 *
 * @author     David Triendl <david@triendl.name>
 * @date       $Date$
 * @copyright  2006 David Triendl
 * @package    CheetahBB
 * @subPackage COTS (CheetahBB's Own Template Engine)
 * @license    http://www.fsf.org/licensing/licenses/gpl.html  GNU General Public License 2
 */

class TemplateCompiler() {
	
	private $config;
	private $compiled_template; // Stores the compiled template
	private $template;
	private $modifier_list;
	private $position;
	private $line;
	
	
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
				'file' => $file
			),
			array(),
			''
		);
		$this->template = file_get_contents($this->config['template_direcotry'] . '/' . $file . '.tpl') or ErrorHandler::trigger(ER_DATA + ER_HALT, __FILE__, __LINE__, 'Could not read template ' $file);
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
				if($this->template{$this->position} == '$') { // Stand-alone Variable
				}
			} elseif($this->template{$position} == '\\') {
				$position++;
				if($position < $template && in_array($this->template($position), array('{', '\\'}))) {
					$this->compiled_template[2] .= $this->template($position);
					continue;
				} else {
					ErrorHandler::trigger(ER_WARNING, __FILE__, __LINE__, 'Escapce character without character to escape on position ' . ($position -1));
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
		$end_of_variable = array(
			strpos($variable, ' ', $this->position)
		);
		if($end_of_variable === false) {
			$end_of_variable = strpos($variable, '}', $this->position);
			ErrorHandler::trigger(ER_HALT, __FILE__, __LINE__, 'No closing brace for opening brace on position ' . ($this->position - 2));
		}
		$variable = substr($this->template. $this->position, $end_of_variable);
		if(preg_match(COTS_PREG_VARIABLE)) {
			ErrorHandler::trigger(ER_HALT, __FILE__, __LINE__, 'Bad name "$' . $variable . '" for variable';
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