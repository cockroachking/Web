# Web
Web-facing tool/page development

## Setting up an instance of TM's databases and web front end

The server should be running an instance of MySQL server (5.7.30 as of this writing) and the apache web server (2.4.43 as of this writing).  The web server needs to have PHP enabled (version 7.2.30 as of this writing) with the mysqli, ctype, and json extensions, and mod_php72 to get the loadable module.  The remaining instructions assume apache, MySQL, and PHP are all working together properly.  On FreeBSD, this involved installing the correct packages.

Note: the MySQL server needs to override the `group_concat_max_len` parameter to be the maximum length of any comma-separated list of users that might be returned by a `GROUP_CONCAT`.  This is currently set to 10000 on the production server.

### MySQL database

First, create the users needed for the database.  Connect and authenticate as root to the MySQL server.  Create passwords for an account that will have permission to administer the TM database that will be used for database updates and an account that will have only read permission that will be used by the web front end.  In the example below, these use the TM default names "travmapadmin" and "travmap".

```
CREATE USER 'travmapadmin'@'localhost' IDENTIFIED WITH mysql_native_password BY 'YOURPASSWORDFORTHISUSER';
CREATE USER 'travmap'@'localhost' IDENTIFIED WITH mysql_native_password BY 'YOURPASSWORDFORTHISUSER';
```

To be able to update the database remotely by ssh, a file `~/.my.cnf` can be created on the server with the password for travmapadmin:

```
[clienttmapadmin]
password = YOURPASSWORDFORTHISUSER
```

Be sure the permissions are 600, so only readable by the user.

Next, we create the database and give these users needed permissions.

```
CREATE DATABASE TravelMapping;
GRANT SELECT ON `TravelMapping`.* TO 'travmap'@'localhost';
GRANT SELECT, INSERT, UPDATE, DELETE, CREATE, DROP, INDEX, REFERENCES ON `TravelMapping`.* TO 'travmapadmin'@'localhost';
```

If you have a `TravelMapping.sql` file (generated by the site update process), you can now try to use it to populate the `TravelMapping` database. 

```
mysql --defaults-group-suffix=tmapadmin -u travmapadmin TravelMapping < TravelMapping.sql
```

Normally, the above will be run as part of the site update process but it is done here as a way to test the database setup.

The TM production server has two database instances so there's (almost) always a fully-populated one from which the site can run, even when the other is being updated.  To do create the second, the above steps would be repeated for another database instance named `TravelMappingCopy`.

### Web server files

The files in this Web repository should be placed in a directory served by the web server.  We assume `/home/www/tm` and a vhosts entry that Apache uses to direct a URL to use files from this location.  The `updateserver.sh` can help populate and later update this directory.  Note that the `fonts` directory is not updated by this script, and those files will need to be transferred separately.

In addition to the files in the repository, the file `lib/tm.conf` needs to be created.  This file contains eight lines:

<pre>
Line 1: DB name (likely TravelMapping)
Line 2: DB read-only user (likely travmap)
Line 3: DB read-only user password
Line 4: DB hostname (likely localhost)
Line 5: HERE map id
Line 6: HERE map code
Line 7: ThunderForest map key
Line 8: MapBox token
</pre>

This file needs to be readable by the web server but should not be served by the web server.  Configure Apache to ensure this.  There are various ways to accomplish this.  On the TM production server, this is done with this global directive in `httpd.conf`:

```
<Files "tm.conf*">
    Require all denied
</Files>
```

Note that the wildcard match is needed, as tm.conf on the server is a symbolic link created by `localupdate.sh` which points to either `tm.conf.updating` (during a site update that is affecting the primary database) or `tm.conf.standard` (when no site update is in progress, or when the primary database has finished being populated and the database copy is being updated).

Also create a file `motd` in the root directory of the server.  This is the "message of the day" for TM.

Create a directory named `cache` in the shields directory.  This needs to be writable by the web server.

TM's maps are provided by the [Leaflet library](https://leafletjs.com/), various options for map tiles come through [leaflet-providers](https://github.com/leaflet-extras/leaflet-providers), and some of our waypoint markers (in HDX, so not part of a standalone TM installation) come from [BeautifyMarker](https://github.com/marslan390/BeautifyMarker).  The JS files for these should be placed into a location so they can be read by the code generated by `tm_common_js` in `lib/tmphpfuncs.php`.

Now test it out.  Hopefully everything will work!
