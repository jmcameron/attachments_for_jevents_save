# Makefile for linux

VERSION = "3.2.1"
VERSION2 = $(shell echo $(VERSION)|sed 's/ /-/g')
ZIPFILE = plg_attachments_for_jevents_save_$(VERSION2).zip

FILES = *.php *.xml language/*/*

all: $(ZIPFILE)

ZIPIGNORES = -x "*.zip" -x "*~" -x "*.git/*" -x "*.gitignore" -x Makefile -x "temp/*"

$(ZIPFILE): $(FILES)
	@echo "-------------------------------------------------------"
	@echo "Creating plugin zip file: $(ZIPFILE)"
	@echo ""
	@zip -r $@ * $(ZIPIGNORES)
	@echo "-------------------------------------------------------"
	@echo "done"
