<div class="wrap">
<h2>s2member - PERSONAL PAGE</h2>


<form method="post" action="options.php">
    <?php settings_fields( S2MEMBER_PRIVATE_PAGE_OPTION_GROUP ); ?>

    <table class="form-table">
        
        <?php 
        /*
        
        // TODO
        <tr valign="top">
            <th scope="row"><?php _e('Post name') ?></th>
            <td>
                <input type="text" name="post_name" value="<?php echo get_option(S2MEMBER_PRIVATE_PAGE_OPTION_PREFIX. 'post_name', __('Private area')); ?>" />
            </td>
        </tr>
        */
        ?>

        <tr valign="top">
            <th scope="row"><?php _e('Post title') ?></th>
            <td>
                <input type="text" name="<?php echo S2MEMBER_PRIVATE_PAGE_OPTION_PREFIX ?>post_title" value="<?php echo get_option(S2MEMBER_PRIVATE_PAGE_OPTION_PREFIX. 'post_title', __('Private area')); ?>" />
            </td>
        </tr>
         
        <tr valign="top">
            <th scope="row"><?php _e('Post content') ?></th>
            <td>
                <textarea style="width:100%" rows="10" name="<?php echo S2MEMBER_PRIVATE_PAGE_OPTION_PREFIX ?>post_content"><?php echo get_option(S2MEMBER_PRIVATE_PAGE_OPTION_PREFIX. 'post_content', __('Private area')); ?></textarea>
            </td>
        </tr>


        <tr valign="top">
            <th scope="row"><?php _e('Post parent') ?></th>
            <td>
                <input type="text" name="<?php echo S2MEMBER_PRIVATE_PAGE_OPTION_PREFIX ?>post_parent" value="<?php echo get_option(S2MEMBER_PRIVATE_PAGE_OPTION_PREFIX. 'post_parent', 0); ?>" />
            </td>
        </tr>


        <tr valign="top">
            <th scope="row"><?php _e('Post template') ?></th>
            <td>
                <select name="<?php echo S2MEMBER_PRIVATE_PAGE_OPTION_PREFIX ?>post_template" id="">
                    <option value="page.php"><?php _e('Default') ?></option>

                    <?php foreach (get_page_templates() as $name => $file) : $selected = get_option(S2MEMBER_PRIVATE_PAGE_OPTION_PREFIX. 'post_template') == $file ? 'selected="selected"' : '' ?>
                        <option value="<?php echo $file ?>" <?php echo $selected ?>><?php echo $name ?></option>
                    <?php endforeach ?>
                </select>
            </td>
        </tr>

        
    </table>
    
    <p class="submit">
    <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
    </p>

</form>
</div>
