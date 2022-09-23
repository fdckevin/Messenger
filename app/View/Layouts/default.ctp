<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $this->fetch('title'); ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->meta('myToken', $this->request->param('csrfToken'));

		echo $this->Html->css('//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css');

		echo $this->Html->css('https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');

    echo $this->Html->css('https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css');

		echo $this->Html->css('messenger.css');

		echo $this->Html->script('//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js');

		echo $this->Html->script('//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js');

    echo $this->Html->script('https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js');

		echo $this->Html->script('https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.21.0/moment.min.js');

    echo $this->Html->script('http://localhost:4000/socket.io/socket.io.js');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>

<?php if($loggedIn): ?>
<nav class="navbar navbar-expand-sm bg-primary navbar-dark">
  <div class="navbar-nav">
    <li class="nav-item">
      <?php echo $this->Html->link('Home', '/home', array('class' => 'nav-link'));?>
    </li>
  </div>
  <div class="navbar-nav ml-auto">
  	<li class="nav-item dropdown">
  		<a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
        <?php echo $user[0]['User']['email']; ?>
      </a>
      <div class="dropdown-menu">
         <?php echo $this->Html->link('My Profile', '/home/profile', array('class' => 'dropdown-item'));?>
      	 <?php echo $this->Html->link('Logout', '/logout', array('class' => 'dropdown-item'));?>
      </div>
  	</li>
  </div>
</nav>
<?php endif;?>
<div class="container">
	<script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="myToken"]').attr('content')
            }
        });
	</script>
	<?php echo $this->fetch('content'); ?>
</div>

</body>
</html>
