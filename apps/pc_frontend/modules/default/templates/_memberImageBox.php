<?php
$options = array(
  'object'      => $sf_user->getMember(),
  'moreInfo' => array(
    link_to(__('Edit Photo'), 'member/configImage'),
    link_to(__('Show Profile'), 'member/profile'),
  ),
);
op_include_parts('memberImageBox', 'memberImageBox_'.$gadget->getId(), $options);