TITLE = [project]

##############################################################################################
####################################### C O M P O S E R ######################################
##############################################################################################

autoload:
	@/bin/echo "${TITLE} generating autoloader..." \
	&& composer dump-autoload --optimize

install:
	@/bin/echo "${TITLE} installing dependencies and dev dependencies..." \
	&& COMPOSER_ALLOW_SUPERUSER=1 composer install --optimize-autoloader --no-plugins --no-scripts \
	&& /bin/echo "${TITLE} dependencies installed"