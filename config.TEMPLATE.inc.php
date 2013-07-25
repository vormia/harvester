; <?php exit(); // DO NOT DELETE ?>
; DO NOT DELETE THE ABOVE LINE!!!
; Doing so will expose this configuration file through your web site!
;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;

;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;
;
; config.TEMPLATE.inc.php
;
; Copyright (c) 2005-2012 Alec Smecher and John Willinsky
; Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
;
; Open Harvester Systems Configuration settings.
; Rename config.TEMPLATE.inc.php to config.inc.php to use.
;
; $Id$
;
;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;


;;;;;;;;;;;;;;;;;;;;
; General Settings ;
;;;;;;;;;;;;;;;;;;;;

[general]

; Set this to On once the system has been installed
; (This is generally done automatically by the installer)
installed = Off

; The canonical URL to the harvester installation (excluding the trailing slash)
base_url = "http://pkp.sfu.ca/ohs"

; Path to the registry directory (containing various settings files)
; Although the files in this directory generally do not contain any
; sensitive information, the directory can be moved to a location that
; is not web-accessible if desired
registry_dir = registry

; Session cookie name
session_cookie_name = HARVESTERSID

; Session cookie path; if not specified, defaults to the detected base path
; session_cookie_path = /

; Number of days to save login cookie for if user selects to remember
; (set to 0 to force expiration at end of current session)
session_lifetime = 30

; Short and long date formats
date_format_trunc = "%m-%d"
date_format_short = "%Y-%m-%d"
date_format_long = "%B %e, %Y"
datetime_format_short = "%Y-%m-%d %I:%M %p"
datetime_format_long = "%B %e, %Y - %I:%M %p"

; Use URL parameters instead of CGI PATH_INFO. This is useful for
; broken server setups that don't support the PATH_INFO environment
; variable.
disable_path_info = Off

; Use fopen(...) for URL-based reads. Modern versions of dspace
; will not accept requests using fopen, as it does not provide a
; User Agent, so this option is disabled by default. If this feature
; is disabled by PHP's configuration, this setting will be ignored.
allow_url_fopen = Off

; Generate RESTful URLs using mod_rewrite.  This requires the
; rewrite directive to be enabled in your .htaccess or httpd.conf.
; See FAQ for more details.
restful_urls = Off

; Impose a minimum number of seconds between requests. Useful if a
; data source has a throttling policy.
; throttling_delay = 3500

; Allow javascript files to be served through a content delivery network (set to off to use local files)
enable_cdn = On

; Number of parallel process to use when parallel harvesting is selected
harvesting_max_processes = 10

;;;;;;;;;;;;;;;;;;;;;
; Database Settings ;
;;;;;;;;;;;;;;;;;;;;;

[database]

driver = mysql
host = localhost
username = harvester2
password = harvester2
name = harvester2

; Enable persistent connections (recommended)
persistent = On

; Enable database debug output (very verbose!)
debug = Off


;;;;;;;;;;;;;;;;;
; File Settings ;
;;;;;;;;;;;;;;;;;

[files]

; Path to the directory to store public uploaded files
; (This directory should be web-accessible and the specified path
; should be relative to the base Open Harvester Systems directory)
public_files_dir = public

; Permissions mask for created files and directories
umask = 0022


;;;;;;;;;;;;;;;;;;
; Cache Settings ;
;;;;;;;;;;;;;;;;;;

[cache]

; The type of data caching to use. Options are:
; - memcache: Use the memcache server configured below
; - file: Use file-based caching; configured below
; - none: Use no caching. This may be extremely slow.
; This setting affects locale data, settings, etc.

cache = file

; Enable memcache support
memcache_hostname = localhost
memcache_port = 11211

;;;;;;;;;;;;;;;;;;;;;;;;;
; Localization Settings ;
;;;;;;;;;;;;;;;;;;;;;;;;;

[i18n]

; Default locale
locale = en_US

; Client output/input character set
client_charset = utf-8

; Database connection character set
; Must be set to "Off" if not supported by the database server
; If enabled, must be the same character set as "client_charset"
; (although the actual name may differ slightly depending on the server)
connection_charset = Off

; Database storage character set
; Must be set to "Off" if not supported by the database server
database_charset = Off

; Enable character normalization to utf-8 (recommended)
; If disabled, strings will be passed through in their native encoding
; Note that client_charset and database collation must be set
; to "utf-8" for this to work, as characters are stored in utf-8
charset_normalization = On


;;;;;;;;;;;;;;;;;;;;;
; Security Settings ;
;;;;;;;;;;;;;;;;;;;;;

[security]

; Force SSL connections site-wide
force_ssl = Off

; Force SSL connections for login only
force_login_ssl = Off

; This check will invalidate a session if the user's IP address changes.
; Enabling this option provides some amount of additional security, but may
; cause problems for users behind a proxy farm (e.g., AOL).
session_check_ip = On

; The encryption (hashing) algorithm to use for encrypting user passwords
; Valid values are: md5, sha1
encryption = sha1

; Allowed HTML tags for fields that permit restricted HTML.
; For PHP 5.0.5 and greater, allowed attributes must be specified individually
; e.g. <img src alt> to allow "src" and "alt" attributes. Unspecified
; attributes will be stripped. For PHP below 5.0.5 attributes may not be
; specified in this way.
allowed_html = "a[href|target],em,strong,cite,code,ul,ol,li,dl,dt,dd,b,i,u,img[src|alt],sup,sub,br,p"


;;;;;;;;;;;;;;;;;;
; Email Settings ;
;;;;;;;;;;;;;;;;;;

[email]

; Use SMTP for sending mail instead of mail()
; smtp = On

; SMTP server settings
; smtp_server = mail.example.com
; smtp_port = 25

; Enable SMTP authentication
; Supported mechanisms: ssl, tls
; smtp_auth = ssl
; smtp_username = username
; smtp_password = password

; Allow envelope sender to be specified
; (may not be possible with some server configurations)
; allow_envelope_sender = Off

; If enabled, email addresses must be validated before login is possible.
require_validation = Off


;;;;;;;;;;;;;;;;;;;
; Search Settings ;
;;;;;;;;;;;;;;;;;;;

[search]

; Minimum indexed word length
min_word_length = 2

; Maximum indexed word length (words above this length will be truncated)
max_word_length = 40

; The maximum number of search results fetched per keyword. These results
; are fetched and merged to provide results for searches with several keywords.
results_per_keyword = 500

; The number of hours for which keyword search results are cached.
result_cache_hours = 1


;;;;;;;;;;;;;;;;
; OAI Settings ;
;;;;;;;;;;;;;;;;

[oai]

; Enable OAI front-end to the site
oai = On

; OAI Repository identifier
repository_id = harvester2.pkp.sfu.ca


;;;;;;;;;;;;;;;;;;;;;;
; Interface Settings ;
;;;;;;;;;;;;;;;;;;;;;;

[interface]

; Number of items to display per page
items_per_page = 25

; Number of page links to display
page_links = 10


;;;;;;;;;;;;;;;;;;;;
; Captcha Settings ;
;;;;;;;;;;;;;;;;;;;;

[captcha]

; Whether or not to enable ReCaptcha
recaptcha = off

; Public key for reCaptcha (see http://www.google.com/recaptcha)
recaptcha_public_key = your_public_key

; Private key for reCaptcha (see http://www.google.com/recaptcha)
recaptcha_private_key = your_private_key

; Whether or not to use Captcha on user registration
captcha_on_register = on

; Whether or not to use Captcha on user archive submission
captcha_on_submit = on


;;;;;;;;;;;;;;;;;;;;;
; External Commands ;
;;;;;;;;;;;;;;;;;;;;;

[cli]

; These are paths to (optional) external binaries used in
; certain plug-ins or advanced program features.

; Using full paths to the binaries is recommended.

; perl (used in paracite citation parser)
perl = /usr/bin/perl

; tar (used in backup plugin, translation packaging)
tar = /bin/tar

; On systems that do not have PHP4's Sablotron/xsl or PHP5's libxsl/xslt
; libraries installed, or for those who require a specific XSLT processor,
; you may enter the complete path to the XSLT renderer tool, with any
; required arguments. Use %xsl to substitute the location of the XSL
; stylesheet file, and %xml for the location of the XML source file; eg:
; /usr/bin/java -jar ~/java/xalan.jar -HTML -IN %xml -XSL %xsl
xslt_command = ""


;;;;;;;;;;;;;;;;;;
; Proxy Settings ;
;;;;;;;;;;;;;;;;;;

[proxy]

; Note that allow_url_fopen must be set to Off before these proxy settings
; will take effect.

; The HTTP proxy configuration to use
; http_host = localhost
; http_port = 80
; proxy_username = username
; proxy_password = password


;;;;;;;;;;;;;;;;;;
; Debug Settings ;
;;;;;;;;;;;;;;;;;;

[debug]

; Display a stack trace when a fatal error occurs.
; Note that this may expose private information and should be disabled
; for any production system.
show_stacktrace = Off

; Display an error message when something goes wrong.
display_errors = Off

; Display deprecation warnings
deprecation_warnings = Off
