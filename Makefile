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
	@cp -r $(CURDIR)/entrypoint $(CURDIR)/$@/entrypoint
	@docker build -t ippart/backend .

composer:
	@-docker run --rm -v $(CURDIR):/data imega/composer install --ignore-platform-reqs

start:
	@docker run -d --name "ippart_db" -v $(CURDIR)/conf.d/mysql:/etc/mysql/conf.d imega/mysql

	@-docker run --rm \
		-v $(CURDIR)/sql:/sql \
		--link ippart_db:ippart_db \
		imega/mysql-client \
		mysql --host=ippart_db -e "source /sql/ippart.sql"

	@docker pull ippart/backend
	@docker run -d \
		--name "ippart" \
		--link ippart_db:ippart_db \
		ippart/backend

	@docker run -d \
		--name "ippart_nginx" \
		--link ippart:service \
		-v $(CURDIR)/conf.d/nginx:/conf \
		-p 8900:80 \
		nginx:alpine sh -c '/usr/sbin/nginx -g "daemon off;" -p /app -c /conf/nginx.conf'
