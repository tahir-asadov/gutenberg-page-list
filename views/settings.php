<?php
  $pages = get_pages();
  $included_pages = explode(',', get_option('gutenberg_page_list_included_pages'));
  $excluded_pages = explode(',', get_option('gutenberg_page_list_excluded_pages'));
?>

<div class="wrap gutenberg-page-list">
  <h1><?php echo __('Gutenberg Page List Settings', 'gutenberg-page-list'); ?></h1>


  <form method="post" action="options.php">

    <?php settings_fields('gutenberg_page_list_settings'); ?>
    <?php do_settings_sections('gutenberg_page_list_settings'); ?>

    <h2><?php echo __('Included pages', 'gutenberg-page-list'); ?></h2>

    <div class="page-list-container">

      <div class="page-list-container-top">
        <select>
          <option value=""><?php echo __('Select page to include', 'gutenberg-page-list'); ?></option>
          <?php if($pages):?>
            <?php foreach ($pages as $key => $value):?>
              <option value="<?php echo $value->ID; ?>"><?php echo $value->post_title; ?></option>
            <?php endforeach; ?>
          <?php endif; ?>
        </select>
        <button class="button add_to_list"><?php echo __('Add to list', 'gutenberg-page-list'); ?></button>
      </div><!-- .page-list-container-top -->

      <div class="included-pages page-list">
        <?php foreach ($pages as $key => $value):?>
          <?php if(in_array($value->ID, $included_pages)):?>
          <span id="<?php echo $value->ID; ?>"><?php echo $value->post_title; ?></span>
          <?php endif;?>
        <?php endforeach; ?>
      </div><!-- .included-pages -->

      <input type="hidden" class="list" name="gutenberg_page_list_included_pages" value="<?php echo get_option('gutenberg_page_list_included_pages'); ?>">

    </div><!-- .page-list-container -->

    <h2><?php echo __('Excluded pages', 'gutenberg-page-list'); ?></h2>

    <div class="page-list-container">

      <div class="page-list-container-top">
        <select>
          <option value=""><?php echo __('Select page to exclude', 'gutenberg-page-list'); ?></option>
          <?php if($pages):?>
            <?php foreach ($pages as $key => $value):?>
              <option value="<?php echo $value->ID; ?>"><?php echo $value->post_title; ?></option>
            <?php endforeach; ?>
          <?php endif; ?>
        </select>
        <button class="button add_to_list"><?php echo __('Add to list', 'gutenberg-page-list'); ?></button>
      </div><!-- .page-list-container-top -->

      <div class="included-pages page-list">
        <?php foreach ($pages as $key => $value):?>
          <?php if(in_array($value->ID, $excluded_pages)):?>
          <span id="<?php echo $value->ID; ?>"><?php echo $value->post_title; ?></span>
          <?php endif;?>
        <?php endforeach; ?>
      </div><!-- .included-pages -->

    
      <input type="hidden" class="list" name="gutenberg_page_list_excluded_pages" value="<?php echo get_option('gutenberg_page_list_excluded_pages'); ?>">

    </div><!-- .page-list-container -->

    <?php submit_button(); ?>
  </form>
</div><!-- .wrap -->


<style>
  .gutenberg-page-list .page-list {
    display: flex;
    flex-wrap: wrap;
    width: 80%;
    max-width: 260px;
    gap: 5px;
  }

  .page-list-container-top {
    display: flex;
    gap: 5px;
    margin-bottom: 10px;
  }

  .gutenberg-page-list .page-list span {
    color: #2271b1;
    background: #f6f7f7;
    border: solid 1px #2271b1;
    padding: 3px 5px;
    cursor: pointer;
    font-size: 13px;
    border-radius: 3px;
  }
</style>

<script>
  jQuery(document).on('click', '.gutenberg-page-list .page-list-container .page-list span', function() {

    let parent = jQuery(this).parents('.page-list-container');
    let list = parent.find('.page-list');
    let page_ids = [];

    jQuery(this).remove();

    list.find('span').map((index, span) => {
      page_ids.push(jQuery(span).attr('id'));
    });
  
    parent.find('input.list').val(page_ids);

  });

  jQuery('.gutenberg-page-list .page-list-container button.add_to_list').click(function(){
    let parent = jQuery(this).parents('.page-list-container');
    let list = parent.find('.page-list');
    let page_id = parent.find('select').val();
    if( parseInt(page_id) > 0 && list.find(`span[id="${page_id}"]`).length == 0 ){

      let page_title = parent.find('select option[value="'+page_id+'"]').text();
      list.append(`<span id="${page_id}">${page_title}</span>`);

      let page_ids = [];
  
      list.find('span').map((index, span) => {
        page_ids.push(jQuery(span).attr('id'));
      });
  
      parent.find('input.list').val(page_ids);
    }

    return false;

  });

</script>