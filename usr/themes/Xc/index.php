<?php

/**
 * “ 心中无女人，代码自然神 ” <br /> “ 环境推荐：PHP 7.4 ”
 * @package Xc-Theme
 * @author 狱长
 * @link https://www.xccx.cc
 */

?>
<?php if ($this->options->Xc_Theme_pattern === '01') : ?><?php $this->need('Xccx/index1.php'); ?><?php endif; ?>
<?php if ($this->options->Xc_Theme_pattern === '02') : ?><?php $this->need('Xccx/index2.php'); ?><?php endif; ?>
<?php if ($this->options->Xc_Theme_pattern === '03') : ?><?php $this->need('Xccx/index3.php'); ?><?php endif; ?>
<?php if ($this->options->Xc_Theme_pattern === '04') : ?><?php $this->need('Xccx/index4.php'); ?><?php endif; ?>
<?php if ($this->options->Xc_Theme_pattern === '05') : ?><?php $this->need('Xccx/index5.php'); ?><?php endif; ?>
<?php if ($this->options->Xc_Theme_pattern === '06') : ?><?php $this->need('Xccx/index6.php'); ?><?php endif; ?>
<?php $this->need('public/footer.php'); ?>
</div>
</body>
</html>