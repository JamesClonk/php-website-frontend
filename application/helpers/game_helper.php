<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

function stars_link($number) {
    $stars = "";
    for ($i = 0; $i < $number; $i++) {
        $stars .= anchor("games/score/$number", '<img src="' . base_url() . 'images/games/star.png" alt="*" />', 'class="games_stars_link"');
    }
    return $stars;
}

function system_icon($system) {
    $icon = "";
    switch($system) {
        case "Nintendo Wii":
            $icon = '<img src="' . base_url() . 'images/games/icon_wii.gif">';
            break;
        case "Nintendo DS":
            $icon = '<img src="' . base_url() . 'images/games/icon_nds.gif">';
            break;
        case "Nintendo GBA":
            $icon = '<img src="' . base_url() . 'images/games/icon_gba.gif">';
            break;
        case "Nintendo Gamecube":
            $icon = '<img src="' . base_url() . 'images/games/icon_cube.gif">';
            break;
        case "Nintendo 64":
            $icon = '<img src="' . base_url() . 'images/games/icon_n64.gif">';
            break;
        case "Super Nintendo":
            $icon = '<img src="' . base_url() . 'images/games/icon_snes.gif">';
            break;
        case "NES":
            $icon = '<img src="' . base_url() . 'images/games/icon_nes.gif">';
            break;
        case "Nintendo GameBoy":
            $icon = '<img src="' . base_url() . 'images/games/icon_gb.gif">';
            break;
        case "Nintendo GBC":
            $icon = '<img src="' . base_url() . 'images/games/icon_gbc.gif">';
            break;
        case "Sony Playstation":
            $icon = '<img src="' . base_url() . 'images/games/icon_psx.gif">';
            break;
        case "Sony Playstation 2":
            $icon = '<img src="' . base_url() . 'images/games/icon_ps2.gif">';
            break;
        case "Sony PSP":
            $icon = '<img src="' . base_url() . 'images/games/icon_psp.gif">';
            break;
        case "Sony Playstation 3":
            $icon = '<img src="' . base_url() . 'images/games/icon_ps3.gif">';
            break;
        case "Microsoft Xbox360":
            $icon = '<img src="' . base_url() . 'images/games/icon_xbox360.gif">';
            break;
        case "Microsoft Xbox":
            $icon = '<img src="' . base_url() . 'images/games/icon_xbox.gif">';
            break;
        case "Sega Dreamcast":
            $icon = '<img src="' . base_url() . 'images/games/icon_dc.gif">';
            break;
        case "PC":
            $icon = '<img src="' . base_url() . 'images/games/icon_pc.gif">';
            break;
        default:
            $icon = '???&nbsp;';
            break;
    }
    return $icon;
}

function system_link($id, $title) {
    return anchor("games/system/" . $id, $title);
}

function game_name($title) {
    return str_replace("<br/>", "&nbsp;", $title);
}

function genre_link($id, $title) {
    return anchor("games/genre/" . $id, $title);
}

function rating_link($id, $title) {
    return anchor("games/rating/" . $id, $title);
}

function rating_name($rating) {
    return 'PEGI&nbsp;' . $rating;
}

function company_link($id, $title) {
    return anchor("games/company/" . $id, $title);
}

function game_link($id, $title, $score = NULL) {
    if (isset($score) && $score != NULL) {
        return stars_link($score) . '&nbsp;' . anchor("games/game/" . $id, $title);
    } else {
        return anchor("games/game/" . $id, $title);
    }
}

function title_link($char, $title = NULL) {
    if (isset($title) && $title != NULL) {
        return anchor("games/title/" . $char, $title);
    } else {
        return anchor("games/title/" . strtoupper($char), $char);
    }
}

/* End of file game_helper.php */
/* Location: ./application/helpers/game_helper.php */