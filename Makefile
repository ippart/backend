build: composer
	@mkdir $(CURDIR)/$@
	@cp -r $(CURDIR)/vendor/opencart/opencart/upload/* $(CURDIR)/$@/
	@mv $(CURDIR)/$@/admin/config-dist.php $(CURDIR)/$@/admin/config.php
	@mv $(CURDIR)/$@/config-dist.php $(CURDIR)/$@/config.php
	@chmod 0755 $(CURDIR)/$@/system/storage/cache/
	@chmod 0755 $(CURDIR)/$@/system/storage/logs/
	@chmod 0755 $(CURDIR)/$@/system/storage/download/
	@chmod 0755 $(CURDIR)/$@/system/storage/upload/
	@chmod 0755 $(CURDIR)/$@/system/storage/modification/
	@chmod 0755 $(CURDIR)/$@/image/
	@chmod 0755 $(CURDIR)/$@/image/cache/
	@chmod 0755 $(CURDIR)/$@/image/catalog/
	@chmod 0755 $(CURDIR)/$@/config.php
	@chmod 0755 $(CURDIR)/$@/admin/config.php
	@cp -r $(CURDIR)/vendor $(CURDIR)/$@/vendor
	@docker build -t ippart/backend .

composer:
	@-docker run --rm -v $(CURDIR):/data imega/composer install --ignore-platform-reqs
