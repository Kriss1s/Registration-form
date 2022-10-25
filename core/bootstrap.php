<?php

$config = require 'config.php';

require 'core/Router.php';
require 'core/Request.php';
require 'core/Validation.php';
require 'core/database/QueryBuilder.php';
require 'core/database/Connection.php';

$pdo = Connection::connectDB($config['database']);

return new QueryBuilder($pdo);
