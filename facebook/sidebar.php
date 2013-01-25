<div id="leftCol">
                  <ul class="left-widget">
                  <?php if ( ! dynamic_sidebar( 'left-widget-area' ) ) : ?>
                      <li id="meta" class="widget-container">
                          <ul>
                              <?php wp_register(); ?>
                              <li><?php wp_loginout(); ?></li>
                          </ul>
                      </li>
                  <?php endif; ?>  
                     <li class="widget-container widget_multicollinks">
                          <h3 class="widget-title">Blogroll</h3>
                          <ul>
<?php wp_list_bookmarks( 'title_li=&categorize=0&orderby=rand&class=widget-container linkcat&title_before=<h3 class=widget-title>&title_after=</h3>' ); ?>
                          </ul>
                      </li>
                    <div class="hr-sidebar"></div>
                    <li class="widget-container cclicense webfont">
                      <a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/3.0/" target="_blank"><span class="ccimage" title="Creative Commons License"></span></a>This work is licensed under a <a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/3.0/" target="_blank">Creative Commons Attribution-NonCommercial-ShareAlike 3.0 Unported License</a>.
                    </li>
                  </ul>
                </div>
