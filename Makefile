# path to deploy dir
BASEPATH = /var/www/default/
PROJNAME = $$(basename $$(pwd))
DEPPATH  = $(BASEPATH)$(PROJNAME)
RFLAGS   = -vrlthCE --delete-delay
IGNNAME  = .deployignore

.PHONY: symulate deploy

symulate:
	rsync -n $(RFLAGS) --exclude-from $(IGNNAME) ./ $(DEPPATH)

deploy:
	rsync $(RFLAGS) --exclude-from $(IGNNAME) ./ $(DEPPATH)
	chgrp -R www-data $(DEPPATH)
	chmod -R g+rw $(DEPPATH)
