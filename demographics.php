<div class="tmcpt-meta-box">

	<p class="meta-options tmcpt-field">
		<label for="tmcpt_pro_title">Professional Title:</label>
		<input id="tmcpt_pro_title" type="text" name="tmcpt_pro_title" value="<?php echo esc_attr(get_post_meta(get_the_ID(), 'tmcpt_pro_title', true)); ?>">
	</p>

    <p class="meta-options tmcpt-field">
        <label for="tmcpt_pro_email">Email:</label>
        <input id="tmcpt_pro_email" type="email" name="tmcpt_pro_email" value="<?php echo esc_attr(get_post_meta(get_the_ID(), 'tmcpt_pro_email', true)); ?>">
    </p>

    <p class="meta-options tmcpt-field">
        <label for="tmcpt_pro_phone">Phone:</label>
        <input id="tmcpt_pro_phone" type="tel" name="tmcpt_pro_phone" value="<?php echo esc_attr(get_post_meta(get_the_ID(), 'tmcpt_pro_phone', true)); ?>">
    </p>

</div>
<style>
    div.tmcpt-meta-box {
        clear: both;
    }
    p.tmcpt-field {
        width: 50%;
        padding-left: 1rem;
    }
    p.tmcpt-field label {
        width: 30%;
        display: inline-block;
    }
    p.tmcpt-field input {
        display: inline-block;
        width: 50%;
        margin: 0;
    }
</style>