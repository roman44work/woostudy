<?php

class Woostudy_Menu_Categories extends Walker_Nav_Menu
{

    public function start_lvl (&$output, $depth = 0, $args = null)
    {
        if ( isset($args -> item_spacing) && 'discard' === $args -> item_spacing ) {
            $t = '';
            $n = '';
        } else {
            $t = "\t";
            $n = "\n";
        }
        $indent = str_repeat ($t, $depth);

        // Default class.
        $classes = ['dropdown-menu position-absolute rounded-0 border-0 m-0'];

        /**
         * Filters the CSS class(es) applied to a menu list element.
         *
         * @param  string[]  $classes  Array of the CSS classes that are applied to the menu `<ul>` element.
         * @param  stdClass  $args  An object of `wp_nav_menu()` arguments.
         * @param  int  $depth  Depth of menu item. Used for padding.
         *
         * @since 4.8.0
         *
         */
        $class_names = implode (' ', apply_filters ('nav_menu_submenu_css_class', $classes, $args, $depth));
        $class_names = $class_names ? ' class="' . esc_attr ($class_names) . '"' : '';

//        $output .= "{$n}{$indent}<ul$class_names>{$n}";
        $output .= "{$n}{$indent}<div$class_names>{$n}";
    }

    public function end_lvl (&$output, $depth = 0, $args = null)
    {
        if ( isset($args -> item_spacing) && 'discard' === $args -> item_spacing ) {
            $t = '';
            $n = '';
        } else {
            $t = "\t";
            $n = "\n";
        }
        $indent = str_repeat ($t, $depth);
        $output .= "$indent</div></div>{$n}";
    }

    public function start_el (&$output, $data_object, $depth = 0, $args = null, $current_object_id = 0)
    {
        // Restores the more descriptive, specific name for use within this method.
        $menu_item = $data_object;

        if ( isset($args -> item_spacing) && 'discard' === $args -> item_spacing ) {
            $t = '';
            $n = '';
        } else {
            $t = "\t";
            $n = "\n";
        }
        $indent = ($depth) ? str_repeat ($t, $depth) : '';

        $classes   = empty($menu_item -> classes) ? [] : (array) $menu_item -> classes;
        $classes[] = 'menu-item-' . $menu_item -> ID;

        /**
         * Filters the arguments for a single nav menu item.
         *
         * @param  stdClass  $args  An object of wp_nav_menu() arguments.
         * @param  WP_Post  $menu_item  Menu item data object.
         * @param  int  $depth  Depth of menu item. Used for padding.
         *
         * @since 4.4.0
         *
         */
        $args = apply_filters ('nav_menu_item_args', $args, $menu_item, $depth);

        /**
         * Filters the CSS classes applied to a menu item's list item element.
         *
         * @param  string[]  $classes  Array of the CSS classes that are applied to the menu item's `<li>` element.
         * @param  WP_Post  $menu_item  The current menu item object.
         * @param  stdClass  $args  An object of wp_nav_menu() arguments.
         * @param  int  $depth  Depth of menu item. Used for padding.
         *
         * @since 3.0.0
         * @since 4.1.0 The `$depth` parameter was added.
         *
         */
        $class_names = implode (' ', apply_filters ('nav_menu_css_class', array_filter ($classes), $menu_item, $args, $depth));
        $class_names = $class_names ? ' class="' . esc_attr ($class_names) . '"' : '';

        /**
         * Filters the ID attribute applied to a menu item's list item element.
         *
         * @param  string  $menu_item_id  The ID attribute applied to the menu item's `<li>` element.
         * @param  WP_Post  $menu_item  The current menu item.
         * @param  stdClass  $args  An object of wp_nav_menu() arguments.
         * @param  int  $depth  Depth of menu item. Used for padding.
         *
         * @since 3.0.1
         * @since 4.1.0 The `$depth` parameter was added.
         *
         */
        $id = apply_filters ('nav_menu_item_id', 'menu-item-' . $menu_item -> ID, $menu_item, $args, $depth);
        $id = $id ? ' id="' . esc_attr ($id) . '"' : '';

//        $output .= $indent . '<li' . $id . $class_names . '>';
        $output .= $indent;

        $atts           = [];
        $atts['title']  = !empty($menu_item -> attr_title) ? $menu_item -> attr_title : '';
        $atts['target'] = !empty($menu_item -> target) ? $menu_item -> target : '';
        if ( '_blank' === $menu_item -> target && empty($menu_item -> xfn) ) {
            $atts['rel'] = 'noopener';
        } else {
            $atts['rel'] = $menu_item -> xfn;
        }

        if ( !empty($menu_item -> url) ) {
            if ( get_privacy_policy_url () === $menu_item -> url ) {
                $atts['rel'] = empty($atts['rel']) ? 'privacy-policy' : $atts['rel'] . ' privacy-policy';
            }

            $atts['href'] = $menu_item -> url;
        } else {
            $atts['href'] = '';
        }

        $atts['aria-current'] = $menu_item -> current ? 'page' : '';

        if ( $this -> has_children ) {
            $atts ['class']       = 'nav-link dropdown-toggle';
            $atts ['data-toggle'] = 'dropdown';
//            $atts ['href'] = '#';

        } else {
            if ( $depth > 0 ) {
                $atts ['class'] = 'dropdown-item';
            }else{
                $atts ['class'] = 'nav-link nav-item';
            }

        }

        /**
         * Filters the HTML attributes applied to a menu item's anchor element.
         *
         * @param  array  $atts  {
         *     The HTML attributes applied to the menu item's `<a>` element, empty strings are ignored.
         *
         * @type string $title Title attribute.
         * @type string $target Target attribute.
         * @type string $rel The rel attribute.
         * @type string $href The href attribute.
         * @type string $aria-current The aria-current attribute.
         * }
         *
         * @param  WP_Post  $menu_item  The current menu item object.
         * @param  stdClass  $args  An object of wp_nav_menu() arguments.
         * @param  int  $depth  Depth of menu item. Used for padding.
         *
         * @since 3.6.0
         * @since 4.1.0 The `$depth` parameter was added.
         *
         */
        $atts = apply_filters ('nav_menu_link_attributes', $atts, $menu_item, $args, $depth);

        $attributes = '';
        foreach ( $atts as $attr => $value ) {
            if ( is_scalar ($value) && '' !== $value && false !== $value ) {
                $value      = ('href' === $attr) ? esc_url ($value) : esc_attr ($value);
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }

        /** This filter is documented in wp-includes/post-template.php */
        $title = apply_filters ('the_title', $menu_item -> title, $menu_item -> ID);

        /**
         * Filters a menu item's title.
         *
         * @param  string  $title  The menu item's title.
         * @param  WP_Post  $menu_item  The current menu item object.
         * @param  stdClass  $args  An object of wp_nav_menu() arguments.
         * @param  int  $depth  Depth of menu item. Used for padding.
         *
         * @since 4.4.0
         *
         */
        $title = apply_filters ('nav_menu_item_title', $title, $menu_item, $args, $depth);

        $item_output = $args -> before;

        if ($this -> has_children){
            $item_output .= '<div class="nav-item dropdown dropright">';
        }


        $item_output .= '<a' . $attributes . '>';
        $item_output .= $args -> link_before . $title . $args -> link_after;

        if ($this -> has_children){
            $item_output .= '<i class="fa fa-angle-right float-right mt-1"></i>';
        }

        $item_output .= '</a>';
        $item_output .= $args -> after;

        /**
         * Filters a menu item's starting output.
         *
         * The menu item's starting output only includes `$args->before`, the opening `<a>`,
         * the menu item's title, the closing `</a>`, and `$args->after`. Currently, there is
         * no filter for modifying the opening and closing `<li>` for a menu item.
         *
         * @param  string  $item_output  The menu item's starting HTML output.
         * @param  WP_Post  $menu_item  Menu item data object.
         * @param  int  $depth  Depth of menu item. Used for padding.
         * @param  stdClass  $args  An object of wp_nav_menu() arguments.
         *
         * @since 3.0.0
         *
         */
        $output .= apply_filters ('walker_nav_menu_start_el', $item_output, $menu_item, $depth, $args);
    }

    public function end_el (&$output, $data_object, $depth = 0, $args = null)
    {
        if ( isset($args -> item_spacing) && 'discard' === $args -> item_spacing ) {
            $t = '';
            $n = '';
        } else {
            $t = "\t";
            $n = "\n";
        }



//        $output .= "</li>{$n}";
        $output .= $n;
    }


}