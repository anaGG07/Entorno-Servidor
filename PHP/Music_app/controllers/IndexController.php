<?php

if (isset($user_session)) {
  $user = $user_session;
  require_once('views\playlist\UserPlaylistView.phtml');

}
