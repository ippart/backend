build: composer
	@mkdir $@
	@cp -r $(CURDIR)/vendor/opencart/opencart/upload/ $@/
	@mv $@/admin/config-dist.php $@/admin/config.php
	@mv $@/config-dist.php $@/config.php
	@chmod 0755 $@/system/storage/cache/
	@chmod 0755 $@/system/storage/logs/
	@chmod 0755 $@/system/storage/download/
	@chmod 0755 $@/system/storage/upload/
	@chmod 0755 $@/system/storage/modification/
	@chmod 0755 $@/image/
	@chmod 0755 $@/image/cache/
	@chmod 0755 $@/image/catalog/
	@chmod 0755 $@/config.php
	@chmod 0755 $@/admin/config.php
	@cp -r $(CURDIR)/vendor $@/vendor
	@docker build -t ippart/backend .

composer:
	@-docker run --rm -v $(CURDIR):/data imega/composer install --ignore-platform-reqs
