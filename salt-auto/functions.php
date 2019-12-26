<?php

function add_google_font() {
  wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css?family=Montserrat:400,600');
}
add_action( 'wp_enqueue_scripts', 'add_google_font' );

// function add_slick_slider() {
//   wp_enqueue_style( 'slick-css', get_stylesheet_directory_uri() . '/slick/slick.css');
//   wp_enqueue_script( 'slick-script', get_stylesheet_directory_uri() . '/slick/slick.min.js');
// }
// add_action( 'wp_enqueue_scripts', 'add_slick_slider', 20 );

function add_owlcarousel() {
  wp_enqueue_style( 'owl-css', get_stylesheet_directory_uri() . '/owlcarousel/assets/owl.carousel.min.css');
  wp_enqueue_style( 'owl-theme-css', get_stylesheet_directory_uri() . '/owlcarousel/assets/owl.theme.default.min.css');
  wp_enqueue_script( 'owl-script', get_stylesheet_directory_uri() . '/owlcarousel/owl.carousel.min.js');
}
add_action( 'wp_enqueue_scripts', 'add_owlcarousel', 20 );


//Alternative to var_dump() - Also tells you which file called it - found on: https://www.leaseweb.com/labs/2013/10/smart-alternative-phps-var_dump-function/
function var_debug($variable,$strlen=100,$width=25,$depth=10,$i=0,&$objects = array())
{
  $search = array("\0", "\a", "\b", "\f", "\n", "\r", "\t", "\v");
  $replace = array('\0', '\a', '\b', '\f', '\n', '\r', '\t', '\v');

  $string = '';

  switch(gettype($variable)) {
    case 'boolean':      $string.= $variable?'true':'false'; break;
    case 'integer':      $string.= $variable;                break;
    case 'double':       $string.= $variable;                break;
    case 'resource':     $string.= '[resource]';             break;
    case 'NULL':         $string.= "null";                   break;
    case 'unknown type': $string.= '???';                    break;
    case 'string':
      $len = strlen($variable);
      $variable = str_replace($search,$replace,substr($variable,0,$strlen),$count);
      $variable = substr($variable,0,$strlen);
      if ($len<$strlen) $string.= '"'.$variable.'"';
      else $string.= 'string('.$len.'): "'.$variable.'"...';
      break;
    case 'array':
      $len = count($variable);
      if ($i==$depth) $string.= 'array('.$len.') {...}';
      elseif(!$len) $string.= 'array(0) {}';
      else {
        $keys = array_keys($variable);
        $spaces = str_repeat(' ',$i*2);
        $string.= "array($len)\n".$spaces.'{';
        $count=0;
        foreach($keys as $key) {
          if ($count==$width) {
            $string.= "\n".$spaces."  ...";
            break;
          }
          $string.= "\n".$spaces."  [$key] => ";
          $string.= var_debug($variable[$key],$strlen,$width,$depth,$i+1,$objects);
          $count++;
        }
        $string.="\n".$spaces.'}';
      }
      break;
    case 'object':
      $id = array_search($variable,$objects,true);
      if ($id!==false)
        $string.=get_class($variable).'#'.($id+1).' {...}';
      else if($i==$depth)
        $string.=get_class($variable).' {...}';
      else {
        $id = array_push($objects,$variable);
        $array = (array)$variable;
        $spaces = str_repeat(' ',$i*2);
        $string.= get_class($variable)."#$id\n".$spaces.'{';
        $properties = array_keys($array);
        foreach($properties as $property) {
          $name = str_replace("\0",':',trim($property));
          $string.= "\n".$spaces."  [$name] => ";
          $string.= var_debug($array[$property],$strlen,$width,$depth,$i+1,$objects);
        }
        $string.= "\n".$spaces.'}';
      }
      break;
  }

  if ($i>0) return $string;

  $backtrace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
  do $caller = array_shift($backtrace); while ($caller && !isset($caller['file']));
  if ($caller) $string = $caller['file'].':'.$caller['line']."\n".$string;

  echo $string;
}
