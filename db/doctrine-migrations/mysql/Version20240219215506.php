<?php

declare(strict_types=1);

namespace Movary\DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240219215506 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MySQL80Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\MySQL80Platform'."
        );

        $this->addSql('CREATE TABLE cache_letterboxd_diary (
          diary_id VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_0900_ai_ci`,
          letterboxd_id VARCHAR(4) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_0900_ai_ci`,
          PRIMARY KEY(diary_id)
        ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = InnoDB COMMENT = \'\'');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MySQL80Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\MySQL80Platform'."
        );

        $this->addSql('CREATE TABLE cache_tmdb_countries (
          iso_3166_1 CHAR(2) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`,
          english_name VARCHAR(256) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`,
          PRIMARY KEY(iso_3166_1)
        ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\'');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MySQL80Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\MySQL80Platform'."
        );

        $this->addSql('CREATE TABLE cache_tmdb_languages (
          iso_639_1 CHAR(2) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`,
          english_name VARCHAR(256) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`,
          PRIMARY KEY(iso_639_1)
        ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\'');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MySQL80Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\MySQL80Platform'."
        );

        $this->addSql('CREATE TABLE cache_trakt_user_movie_rating (
          trakt_id INT UNSIGNED NOT NULL,
          user_id INT UNSIGNED NOT NULL,
          rating TINYINT(1) DEFAULT NULL,
          rated_at DATETIME NOT NULL,
          INDEX cache_trakt_user_movie_rating_fk_user_id (user_id),
          PRIMARY KEY(trakt_id)
        ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\'');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MySQL80Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\MySQL80Platform'."
        );

        $this->addSql('CREATE TABLE cache_trakt_user_movie_watched (
          user_id INT UNSIGNED NOT NULL,
          trakt_id INT UNSIGNED NOT NULL,
          last_updated_at DATETIME NOT NULL,
          UNIQUE INDEX uniqueTraktId (trakt_id),
          INDEX cache_trakt_user_movie_watched_fk_user_id (user_id)
        ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\'');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MySQL80Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\MySQL80Platform'."
        );

        $this->addSql('CREATE TABLE company (
          id INT UNSIGNED AUTO_INCREMENT NOT NULL,
          name VARCHAR(256) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`,
          origin_country CHAR(2) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`,
          tmdb_id INT UNSIGNED DEFAULT NULL,
          created_at DATETIME NOT NULL,
          updated_at DATETIME DEFAULT NULL,
          UNIQUE INDEX tmdb_id (tmdb_id),
          PRIMARY KEY(id)
        ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\'');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MySQL80Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\MySQL80Platform'."
        );

        $this->addSql('CREATE TABLE genre (
          id INT UNSIGNED AUTO_INCREMENT NOT NULL,
          name VARCHAR(256) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`,
          tmdb_id INT UNSIGNED DEFAULT NULL,
          created_at DATETIME NOT NULL,
          updated_at DATETIME DEFAULT NULL,
          UNIQUE INDEX tmdb_id (tmdb_id),
          UNIQUE INDEX name (name),
          PRIMARY KEY(id)
        ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\'');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MySQL80Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\MySQL80Platform'."
        );

        $this->addSql('CREATE TABLE job_queue (
          id INT UNSIGNED AUTO_INCREMENT NOT NULL,
          user_id INT UNSIGNED DEFAULT NULL,
          job_type TEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`,
          job_status TEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`,
          parameters TEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`,
          updated_at DATETIME DEFAULT NULL,
          created_at DATETIME NOT NULL,
          INDEX user_id (user_id),
          PRIMARY KEY(id)
        ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\'');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MySQL80Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\MySQL80Platform'."
        );

        $this->addSql('CREATE TABLE movie (
          id INT UNSIGNED AUTO_INCREMENT NOT NULL,
          title VARCHAR(256) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`,
          trakt_id INT UNSIGNED DEFAULT NULL,
          imdb_id VARCHAR(10) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`,
          tmdb_id INT UNSIGNED NOT NULL,
          letterboxd_id CHAR(4) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`,
          poster_path VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`,
          tagline TEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`,
          overview TEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`,
          original_language VARCHAR(2) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`,
          runtime SMALLINT DEFAULT NULL,
          release_date DATE DEFAULT NULL,
          tmdb_vote_average NUMERIC(3, 1) DEFAULT NULL,
          tmdb_vote_count INT UNSIGNED DEFAULT NULL,
          tmdb_poster_path VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`,
          tmdb_backdrop_path VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`,
          imdb_rating_average DOUBLE PRECISION DEFAULT NULL,
          imdb_rating_vote_count INT UNSIGNED DEFAULT NULL,
          created_at DATETIME NOT NULL,
          updated_at DATETIME DEFAULT NULL,
          updated_at_tmdb DATETIME DEFAULT NULL,
          updated_at_imdb DATETIME DEFAULT NULL,
          UNIQUE INDEX tmdb_id (tmdb_id),
          UNIQUE INDEX trakt_id (trakt_id),
          UNIQUE INDEX imdb_id (imdb_id),
          PRIMARY KEY(id)
        ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\'');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MySQL80Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\MySQL80Platform'."
        );

        $this->addSql('CREATE TABLE movie_cast (
          person_id INT UNSIGNED NOT NULL,
          movie_id INT UNSIGNED NOT NULL,
          character_name TEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`,
          position SMALLINT UNSIGNED DEFAULT NULL,
          UNIQUE INDEX movie_id (movie_id, position),
          INDEX person_id (person_id),
          INDEX IDX_E1DE98FB8F93B6FC (movie_id)
        ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\'');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MySQL80Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\MySQL80Platform'."
        );

        $this->addSql('CREATE TABLE movie_crew (
          person_id INT UNSIGNED NOT NULL,
          movie_id INT UNSIGNED NOT NULL,
          job VARCHAR(256) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`,
          department VARCHAR(256) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`,
          position SMALLINT UNSIGNED DEFAULT NULL,
          UNIQUE INDEX movie_id (movie_id, position),
          INDEX person_id (person_id),
          INDEX IDX_7A2F61BF8F93B6FC (movie_id)
        ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\'');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MySQL80Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\MySQL80Platform'."
        );

        $this->addSql('CREATE TABLE movie_genre (
          genre_id INT UNSIGNED NOT NULL,
          movie_id INT UNSIGNED NOT NULL,
          position SMALLINT UNSIGNED DEFAULT NULL,
          UNIQUE INDEX genre_id (genre_id, movie_id),
          UNIQUE INDEX movie_id (movie_id, position),
          INDEX IDX_FD1229648F93B6FC (movie_id),
          INDEX IDX_FD1229644296D31F (genre_id)
        ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\'');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MySQL80Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\MySQL80Platform'."
        );

        $this->addSql('CREATE TABLE movie_production_company (
          company_id INT UNSIGNED NOT NULL,
          movie_id INT UNSIGNED NOT NULL,
          position SMALLINT UNSIGNED DEFAULT NULL,
          UNIQUE INDEX company_id (company_id, movie_id),
          UNIQUE INDEX movie_id (movie_id, position),
          INDEX IDX_54F6AE3C8F93B6FC (movie_id),
          INDEX IDX_54F6AE3C979B1AD6 (company_id)
        ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\'');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MySQL80Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\MySQL80Platform'."
        );

        $this->addSql('CREATE TABLE movie_user_rating (
          movie_id INT UNSIGNED NOT NULL,
          user_id INT UNSIGNED NOT NULL,
          rating TINYINT(1) NOT NULL,
          updated_at DATETIME DEFAULT NULL,
          created_at DATETIME NOT NULL,
          INDEX user_id (user_id),
          INDEX IDX_925DB1E88F93B6FC (movie_id),
          PRIMARY KEY(movie_id, user_id)
        ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\'');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MySQL80Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\MySQL80Platform'."
        );

        $this->addSql('CREATE TABLE movie_user_watch_dates (
          movie_id INT UNSIGNED NOT NULL,
          user_id INT UNSIGNED NOT NULL,
          watched_at DATE DEFAULT NULL,
          plays SMALLINT DEFAULT 1,
          comment TEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`,
          position SMALLINT DEFAULT 1 NOT NULL,
          UNIQUE INDEX unique_watched_dates (movie_id, user_id, watched_at),
          INDEX movie_history_fk_user_id (user_id),
          INDEX IDX_5A6339F48F93B6FC (movie_id)
        ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\'');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MySQL80Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\MySQL80Platform'."
        );

        $this->addSql('CREATE TABLE person (
          id INT UNSIGNED AUTO_INCREMENT NOT NULL,
          name VARCHAR(256) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`,
          gender VARCHAR(1) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`,
          known_for_department VARCHAR(256) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`,
          poster_path VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`,
          birth_date DATE DEFAULT NULL,
          biography TEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`,
          place_of_birth VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`,
          death_date DATE DEFAULT NULL,
          tmdb_id INT UNSIGNED DEFAULT NULL,
          imdb_id VARCHAR(10) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`,
          tmdb_poster_path VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`,
          updated_at_tmdb DATETIME DEFAULT NULL,
          created_at DATETIME NOT NULL,
          updated_at DATETIME DEFAULT NULL,
          UNIQUE INDEX tmdb_id (tmdb_id),
          PRIMARY KEY(id)
        ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\'');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MySQL80Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\MySQL80Platform'."
        );

        $this->addSql('CREATE TABLE phinxlog (
          version BIGINT NOT NULL,
          migration_name VARCHAR(100) CHARACTER SET utf8mb3 DEFAULT NULL COLLATE `utf8mb3_unicode_ci`,
          start_time DATETIME DEFAULT NULL,
          end_time DATETIME DEFAULT NULL,
          breakpoint TINYINT(1) DEFAULT 0 NOT NULL,
          PRIMARY KEY(version)
        ) DEFAULT CHARACTER SET utf8mb3 COLLATE `utf8mb3_unicode_ci` ENGINE = InnoDB COMMENT = \'\'');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MySQL80Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\MySQL80Platform'."
        );

        $this->addSql('CREATE TABLE server_setting (
          `key` VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`,
          value VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`,
          UNIQUE INDEX `key` (`key`)
        ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\'');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MySQL80Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\MySQL80Platform'."
        );

        $this->addSql('CREATE TABLE user (
          id INT UNSIGNED AUTO_INCREMENT NOT NULL,
          email VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`,
          name VARCHAR(256) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`,
          password VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`,
          totp_uri CHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`,
          is_admin TINYINT(1) DEFAULT 0,
          dashboard_visible_rows TEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`,
          dashboard_extended_rows TEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`,
          dashboard_order_rows TEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`,
          jellyfin_access_token CHAR(128) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`,
          jellyfin_user_id CHAR(128) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`,
          jellyfin_server_url CHAR(128) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`,
          jellyfin_sync_enabled TINYINT(1) DEFAULT 0,
          jellyfin_webhook_uuid CHAR(36) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`,
          emby_webhook_uuid CHAR(36) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`,
          jellyfin_scrobble_views TINYINT(1) DEFAULT 1 NOT NULL,
          emby_scrobble_views TINYINT(1) DEFAULT 1 NOT NULL,
          privacy_level TINYINT(1) DEFAULT 1,
          date_format_id TINYINT(1) DEFAULT 0,
          plex_webhook_uuid CHAR(36) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`,
          trakt_user_name VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`,
          trakt_client_id VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`,
          plex_client_id CHAR(64) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`,
          plex_client_temporary_code CHAR(64) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`,
          plex_access_token CHAR(128) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`,
          plex_account_id CHAR(64) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`,
          plex_server_url CHAR(128) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`,
          plex_scrobble_views TINYINT(1) DEFAULT 1 NOT NULL,
          plex_scrobble_ratings TINYINT(1) DEFAULT 0 NOT NULL,
          radarr_feed_uuid CHAR(36) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`,
          watchlist_automatic_removal_enabled TINYINT(1) DEFAULT 1 NOT NULL,
          country CHAR(2) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`,
          display_character_names TINYINT(1) DEFAULT 1,
          core_account_changes_disabled TINYINT(1) DEFAULT 0,
          created_at DATETIME NOT NULL,
          UNIQUE INDEX email (email),
          UNIQUE INDEX name (name),
          PRIMARY KEY(id)
        ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\'');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MySQL80Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\MySQL80Platform'."
        );

        $this->addSql('CREATE TABLE user_api_token (
          token CHAR(36) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`,
          user_id INT UNSIGNED NOT NULL,
          created_at DATETIME NOT NULL,
          UNIQUE INDEX user_id (user_id),
          PRIMARY KEY(token)
        ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\'');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MySQL80Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\MySQL80Platform'."
        );

        $this->addSql('CREATE TABLE user_auth_token (
          id INT UNSIGNED AUTO_INCREMENT NOT NULL,
          user_id INT UNSIGNED NOT NULL,
          token VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`,
          expiration_date DATETIME NOT NULL,
          created_at DATETIME NOT NULL,
          INDEX user_auth_token_fk_user_id (user_id),
          UNIQUE INDEX token (token),
          PRIMARY KEY(id)
        ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\'');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MySQL80Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\MySQL80Platform'."
        );

        $this->addSql('CREATE TABLE user_jellyfin_cache (
          movary_user_id INT UNSIGNED AUTO_INCREMENT NOT NULL,
          jellyfin_item_id VARCHAR(256) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`,
          tmdb_id INT UNSIGNED NOT NULL,
          watched TINYINT(1) NOT NULL,
          last_watch_date DATETIME DEFAULT NULL,
          updated_at DATETIME DEFAULT NULL,
          created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL,
          INDEX IDX_CB2B439B818A2998 (movary_user_id),
          PRIMARY KEY(
            movary_user_id, jellyfin_item_id
          )
        ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\'');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MySQL80Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\MySQL80Platform'."
        );

        $this->addSql('CREATE TABLE user_person_settings (
          user_id INT UNSIGNED NOT NULL,
          person_id INT UNSIGNED NOT NULL,
          is_hidden_in_top_lists TINYINT(1) DEFAULT 0,
          updated_at DATETIME NOT NULL,
          INDEX person_id (person_id),
          INDEX IDX_63DF697DA76ED395 (user_id),
          PRIMARY KEY(user_id, person_id)
        ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\'');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MySQL80Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\MySQL80Platform'."
        );

        $this->addSql('CREATE TABLE watchlist (
          movie_id INT UNSIGNED DEFAULT NULL,
          user_id INT UNSIGNED DEFAULT NULL,
          added_at DATETIME NOT NULL,
          UNIQUE INDEX movie_id (movie_id, user_id),
          INDEX user_id (user_id),
          INDEX IDX_340388D38F93B6FC (movie_id)
        ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MySQL80Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\MySQL80Platform'."
        );

        $this->addSql('DROP TABLE cache_letterboxd_diary');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MySQL80Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\MySQL80Platform'."
        );

        $this->addSql('DROP TABLE cache_tmdb_countries');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MySQL80Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\MySQL80Platform'."
        );

        $this->addSql('DROP TABLE cache_tmdb_languages');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MySQL80Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\MySQL80Platform'."
        );

        $this->addSql('DROP TABLE cache_trakt_user_movie_rating');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MySQL80Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\MySQL80Platform'."
        );

        $this->addSql('DROP TABLE cache_trakt_user_movie_watched');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MySQL80Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\MySQL80Platform'."
        );

        $this->addSql('DROP TABLE company');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MySQL80Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\MySQL80Platform'."
        );

        $this->addSql('DROP TABLE genre');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MySQL80Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\MySQL80Platform'."
        );

        $this->addSql('DROP TABLE job_queue');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MySQL80Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\MySQL80Platform'."
        );

        $this->addSql('DROP TABLE movie');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MySQL80Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\MySQL80Platform'."
        );

        $this->addSql('DROP TABLE movie_cast');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MySQL80Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\MySQL80Platform'."
        );

        $this->addSql('DROP TABLE movie_crew');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MySQL80Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\MySQL80Platform'."
        );

        $this->addSql('DROP TABLE movie_genre');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MySQL80Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\MySQL80Platform'."
        );

        $this->addSql('DROP TABLE movie_production_company');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MySQL80Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\MySQL80Platform'."
        );

        $this->addSql('DROP TABLE movie_user_rating');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MySQL80Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\MySQL80Platform'."
        );

        $this->addSql('DROP TABLE movie_user_watch_dates');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MySQL80Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\MySQL80Platform'."
        );

        $this->addSql('DROP TABLE person');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MySQL80Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\MySQL80Platform'."
        );

        $this->addSql('DROP TABLE phinxlog');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MySQL80Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\MySQL80Platform'."
        );

        $this->addSql('DROP TABLE server_setting');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MySQL80Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\MySQL80Platform'."
        );

        $this->addSql('DROP TABLE user');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MySQL80Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\MySQL80Platform'."
        );

        $this->addSql('DROP TABLE user_api_token');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MySQL80Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\MySQL80Platform'."
        );

        $this->addSql('DROP TABLE user_auth_token');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MySQL80Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\MySQL80Platform'."
        );

        $this->addSql('DROP TABLE user_jellyfin_cache');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MySQL80Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\MySQL80Platform'."
        );

        $this->addSql('DROP TABLE user_person_settings');
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MySQL80Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\MySQL80Platform'."
        );

        $this->addSql('DROP TABLE watchlist');
    }
}
