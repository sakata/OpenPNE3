<h2><?php echo __('アプリケーション許可設定') ?></h2>

<p><?php echo __('アプリケーション「%1%」がリソースへのアクセスを希望しています。', array('%1%' => $information->getConsumer()->getName())); ?></p>
<p><?php echo __('許可しますか？') ?></p>

<form method="post" action="<?php echo url_for('@oauth_authorize_token') ?>">
<input type="hidden" name="oauth_token" value="<?php echo $token ?>" />
<input type="submit" name="allow" value="Continue" />
<input type="submit" value="Cancel" />
</form>
