<?php
/**
 * DokuWiki Plugin fksinfomore (Syntax Component)
 *
 * @license GPL 2 http://www.gnu.org/licenses/gpl-2.0.html
 * @author  Lukas Timko <lukast@fykos.cz>
 */

// must be run within Dokuwiki
if (!defined('DOKU_INC')) die();

class syntax_plugin_fksinfomore extends DokuWiki_Syntax_Plugin {
    /**
     * @return string Syntax mode type
     */
    public function getType() {
        return 'container';
    }
    /**
     * @return string Paragraph type
     */
    public function getPType() {
        return 'block';
    }
    
    function getAllowedTypes() {
        return array('container', 'substition', 'protected', 'disabled', 'formatting', 'paragraphs');
    }
    
    /**
     * @return int Sort order - Low numbers go before high numbers
     */
    public function getSort() {
        return 198;
    }

    /**
     * Connect lookup pattern to lexer.
     *
     * @param string $mode Parser mode
     */
    public function connectTo($mode) {
        //$this->Lexer->addSpecialPattern('<FIXME>',$mode,'plugin_fksinfomore');
        $this->Lexer->addEntryPattern('<infomore>(?=.*?</infomore>)',$mode,'plugin_fksinfomore');
    }

    public function postConnect() {
        $this->Lexer->addExitPattern('</infomore>','plugin_fksinfomore');
    }

    /**
     * Handle matches of the fksinfomore syntax
     *
     * @param string $match The match of the syntax
     * @param int    $state The state of the handler
     * @param int    $pos The position in the document
     * @param Doku_Handler    $handler The handler
     * @return array Data for the renderer
     */
    public function handle($match, $state, $pos, Doku_Handler &$handler){
        $data = array($state);
        switch ($state) {
            case DOKU_LEXER_ENTER : 
				// "<spoiler" options ">"
//				$options = substr($match, 7, -1);

		$title = 'Spoiler';
//				if (strpos($options, '|') !== False) {
//					$title = substr($options, strpos($options, '|') + 1);
//				}
				
		$data = array($state, $title);
		break;
	    case DOKU_LEXER_MATCHED :
		break;
	    case DOKU_LEXER_UNMATCHED :
		$data = array($state, $match);
		break;
	    case DOKU_LEXER_EXIT :
		break;
            case DOKU_LEXER_SPECIAL :
		break;
        }

        return $data;
    }

    /**
     * Render xhtml output or metadata
     *
     * @param string         $mode      Renderer mode (supported modes: xhtml)
     * @param Doku_Renderer  $renderer  The renderer
     * @param array          $data      The data from the handler() function
     * @return bool If rendering was successful.
     */
    public function render($mode, Doku_Renderer &$renderer, $data) {
        if($mode == 'xhtml') {
            list($state, $payload) = $data;
            $button = "<button class='fksinfomore_btn'>".$this->getLang('show')."</button>";
            
            switch ($state) {
                case DOKU_LEXER_ENTER : 				
                    $renderer->doc .= "<div class='fksinfomore_wrapper'>".$button."<div class='fksinfomore_content'>";
                    break;
                case DOKU_LEXER_MATCHED :
                    break;
                case DOKU_LEXER_UNMATCHED :
                    $renderer->doc .= $renderer->_xmlEntities($payload);
                    break;
                case DOKU_LEXER_EXIT :
                    $renderer->doc .= "</div></div>";
                    break;
                case DOKU_LEXER_SPECIAL :
                    break;
            }
            
            return true;
        }
        else{
            return false;
        }
    }
}

// vim:ts=4:sw=4:et:
