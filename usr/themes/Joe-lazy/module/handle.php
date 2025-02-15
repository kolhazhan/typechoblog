<div class="haibaodiv" style="width:100%;margin-top: 16px;margin-bottom: 16px;text-align: center;">
    <div class="wrapper">
        <div class="joe_detail__agree">
            <div class="icon ysnidz">
                <div class="tooltip">点赞</div>
                <span class="text"><?php joe\getAgree($this) ?></span>
            </div>
        </div>

        <div class="poster-popover-mask">
            <div class="poster-popover-box">
                <img class="article-poster-images">
                <a class="poster-download"><i class="ri-download-2-line"></i> 下载海报</a>
            </div>
        </div>
        <div id="ClickMezan" class="icon ysnihb article-poster-button">
            <div class="tooltip">海报</div>
            <i class="ri-image-circle-fill"></i>
        </div>

        <div class="reward-overlay" style="display: none;">
            <section class="reward-modal">
                <joe-tabs>
                    <span class="_temp" style="display: none">
                        {tabs-pane label="微信"}<img width="280" height="280" src="https://tu.ltyuanfang.cn/api/fengjing.php?170852422" alt="微信" />{/tabs-pane}
                    </span>
                    <span class="_content" style="display: block;">
                    </span>
                </joe-tabs>
            </section>
        </div>
        <div class="icon ysnizs">
            <div class="tooltip">赞赏</div>
            <span id="chenyuds"><i class="ri-money-cny-circle-line"></i></span>
        </div>
    </div>
</div>