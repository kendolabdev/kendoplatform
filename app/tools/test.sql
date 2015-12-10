insert ignore into picaso_platform_core_type (type_id, name, is_poster, module_name, has_attribute_catalog, table_name) values 
('platform_acl_action', '', '0', 'platform_acl', '', '\\Platform\\Acl\\Model\\AclActionTable')
, ('platform_acl_allow', '', '0', 'platform_acl', '', '\\Platform\\Acl\\Model\\AclAllowTable')
, ('platform_acl_group', '', '0', 'platform_acl', '', '\\Platform\\Acl\\Model\\AclGroupTable')
, ('platform_acl_role', '', '0', 'platform_acl', '', '\\Platform\\Acl\\Model\\AclRoleTable')
, ('platform_captcha_adapter', '', '0', 'platform_captcha', '', '\\Platform\\Captcha\\Model\\CaptchaAdapterTable')
, ('platform_attribute_catalog', '', '0', 'platform_catalog', '', '\\Platform\\Catalog\\Model\\AttributeCatalogTable')
, ('platform_attribute_field_map', '', '0', 'platform_catalog', '', '\\Platform\\Catalog\\Model\\AttributeFieldMapTable')
, ('platform_attribute_field', '', '0', 'platform_catalog', '', '\\Platform\\Catalog\\Model\\AttributeFieldTable')
, ('platform_attribute_map', '', '0', 'platform_catalog', '', '\\Platform\\Catalog\\Model\\AttributeMapTable')
, ('platform_attribute_option', '', '0', 'platform_catalog', '', '\\Platform\\Catalog\\Model\\AttributeOptionTable')
, ('platform_attribute_plugin', '', '0', 'platform_catalog', '', '\\Platform\\Catalog\\Model\\AttributePluginTable')
, ('platform_attribute_section_map', '', '0', 'platform_catalog', '', '\\Platform\\Catalog\\Model\\AttributeSectionMapTable')
, ('platform_attribute_section', '', '0', 'platform_catalog', '', '\\Platform\\Catalog\\Model\\AttributeSectionTable')
, ('platform_catalog_field_map', '', '0', 'platform_catalog', '', '\\Platform\\Catalog\\Model\\CatalogFieldMapTable')
, ('platform_catalog_field', '', '0', 'platform_catalog', '', '\\Platform\\Catalog\\Model\\CatalogFieldTable')
, ('platform_catalog_option', '', '0', 'platform_catalog', '', '\\Platform\\Catalog\\Model\\CatalogOptionTable')
, ('platform_catalog_plugin', '', '0', 'platform_catalog', '', '\\Platform\\Catalog\\Model\\CatalogPluginTable')
, ('platform_catalog_section_map', '', '0', 'platform_catalog', '', '\\Platform\\Catalog\\Model\\CatalogSectionMapTable')
, ('platform_catalog_section', '', '0', 'platform_catalog', '', '\\Platform\\Catalog\\Model\\CatalogSectionTable')
, ('platform_catalog', '', '0', 'platform_catalog', '', '\\Platform\\Catalog\\Model\\CatalogTable')
, ('platform_aggregate', '', '0', 'platform_core', '', '\\Platform\\Core\\Model\\AggregateTable')
, ('platform_block', '', '0', 'platform_core', '', '\\Platform\\Core\\Model\\BlockTable')
, ('platform_core_aggregate', '', '0', 'platform_core', '', '\\Platform\\Core\\Model\\CoreAggregateTable')
, ('platform_core_block', '', '0', 'platform_core', '', '\\Platform\\Core\\Model\\CoreBlockTable')
, ('platform_core_extension', '', '0', 'platform_core', '', '\\Platform\\Core\\Model\\CoreExtensionTable')
, ('platform_core_hook', '', '0', 'platform_core', '', '\\Platform\\Core\\Model\\CoreHookTable')
, ('platform_core_log', '', '0', 'platform_core', '', '\\Platform\\Core\\Model\\CoreLogTable')
, ('platform_core_profile_field', '', '0', 'platform_core', '', '\\Platform\\Core\\Model\\CoreProfileFieldTable')
, ('platform_core_profile_value_string', '', '0', 'platform_core', '', '\\Platform\\Core\\Model\\CoreProfileValueStringTable')
, ('platform_core_profile_value', '', '0', 'platform_core', '', '\\Platform\\Core\\Model\\CoreProfileValueTable')
, ('platform_core_profile_value_text', '', '0', 'platform_core', '', '\\Platform\\Core\\Model\\CoreProfileValueTextTable')
, ('platform_core_type', '', '0', 'platform_core', '', '\\Platform\\Core\\Model\\CoreTypeTable')
, ('platform_core_uid_generator', '', '0', 'platform_core', '', '\\Platform\\Core\\Model\\CoreUidGeneratorTable')
, ('platform_core_value', '', '0', 'platform_core', '', '\\Platform\\Core\\Model\\CoreValueTable')
, ('platform_uid_generator', '', '0', 'platform_core', '', '\\Platform\\Core\\Model\\UidGeneratorTable')
, ('platform_value', '', '0', 'platform_core', '', '\\Platform\\Core\\Model\\ValueTable')
, ('platform_invitation', '', '0', 'platform_invitation', '', '\\Platform\\Invitation\\Model\\InvitationTable')
, ('platform_invitation_type', '', '0', 'platform_invitation', '', '\\Platform\\Invitation\\Model\\InvitationTypeTable')
, ('platform_layout_block_decorator', '', '0', 'platform_layout', '', '\\Platform\\Layout\\Model\\LayoutBlockDecoratorTable')
, ('platform_layout_block', '', '0', 'platform_layout', '', '\\Platform\\Layout\\Model\\LayoutBlockTable')
, ('platform_layout_page', '', '0', 'platform_layout', '', '\\Platform\\Layout\\Model\\LayoutPageTable')
, ('platform_layout_section', '', '0', 'platform_layout', '', '\\Platform\\Layout\\Model\\LayoutSectionTable')
, ('platform_layout_setting', '', '0', 'platform_layout', '', '\\Platform\\Layout\\Model\\LayoutSettingTable')
, ('platform_layout_support_block', '', '0', 'platform_layout', '', '\\Platform\\Layout\\Model\\LayoutSupportBlockTable')
, ('platform_layout_support_section', '', '0', 'platform_layout', '', '\\Platform\\Layout\\Model\\LayoutSupportSectionTable')
, ('platform_layout', '', '0', 'platform_layout', '', '\\Platform\\Layout\\Model\\LayoutTable')
, ('platform_layout_template', '', '0', 'platform_layout', '', '\\Platform\\Layout\\Model\\LayoutTemplateTable')
, ('platform_layout_theme', '', '0', 'platform_layout', '', '\\Platform\\Layout\\Model\\LayoutThemeTable')
, ('platform_mail_adapter', '', '0', 'platform_mail', '', '\\Platform\\Mail\\Model\\MailAdapterTable')
, ('platform_mail_item', '', '0', 'platform_mail', '', '\\Platform\\Mail\\Model\\MailItemTable')
, ('platform_mail_template', '', '0', 'platform_mail', '', '\\Platform\\Mail\\Model\\MailTemplateTable')
, ('platform_mail_translate', '', '0', 'platform_mail', '', '\\Platform\\Mail\\Model\\MailTranslateTable')
, ('platform_mail_transport', '', '0', 'platform_mail', '', '\\Platform\\Mail\\Model\\MailTransportTable')
, ('platform_navigation_item', '', '0', 'platform_navigation', '', '\\Platform\\Navigation\\Model\\NavigationItemTable')
, ('platform_navigation', '', '0', 'platform_navigation', '', '\\Platform\\Navigation\\Model\\NavigationTable')
, ('platform_notification_subscribe', '', '0', 'platform_notification', '', '\\Platform\\Notification\\Model\\NotificationSubscribeTable')
, ('platform_notification', '', '0', 'platform_notification', '', '\\Platform\\Notification\\Model\\NotificationTable')
, ('platform_notification_type', '', '0', 'platform_notification', '', '\\Platform\\Notification\\Model\\NotificationTypeTable')
, ('platform_payment_currency', '', '0', 'platform_payment', '', '\\Platform\\Payment\\Model\\PaymentCurrencyTable')
, ('platform_payment_gateway', '', '0', 'platform_payment', '', '\\Platform\\Payment\\Model\\PaymentGatewayTable')
, ('platform_photo_album', '', '0', 'platform_photo', '', '\\Platform\\Photo\\Model\\PhotoAlbumTable')
, ('platform_photo_category', '', '0', 'platform_photo', '', '\\Platform\\Photo\\Model\\PhotoCategoryTable')
, ('platform_photo_collection', '', '0', 'platform_photo', '', '\\Platform\\Photo\\Model\\PhotoCollectionTable')
, ('platform_photo_cover', '', '0', 'platform_photo', '', '\\Platform\\Photo\\Model\\PhotoCoverTable')
, ('platform_photo', '', '0', 'platform_photo', '', '\\Platform\\Photo\\Model\\PhotoTable')
, ('platform_phrase_language', '', '0', 'platform_phrase', '', '\\Platform\\Phrase\\Model\\PhraseLanguageTable')
, ('platform_phrase', '', '0', 'platform_phrase', '', '\\Platform\\Phrase\\Model\\PhraseTable')
, ('platform_phrase_value', '', '0', 'platform_phrase', '', '\\Platform\\Phrase\\Model\\PhraseValueTable')
, ('platform_relation_item', '', '0', 'platform_relation', '', '\\Platform\\Relation\\Model\\RelationItemTable')
, ('platform_relation_request', '', '0', 'platform_relation', '', '\\Platform\\Relation\\Model\\RelationRequestTable')
, ('platform_relation', '', '0', 'platform_relation', '', '\\Platform\\Relation\\Model\\RelationTable')
, ('platform_relation_type', '', '0', 'platform_relation', '', '\\Platform\\Relation\\Model\\RelationTypeTable')
, ('platform_setting_action', '', '0', 'platform_setting', '', '\\Platform\\Setting\\Model\\SettingActionTable')
, ('platform_setting', '', '0', 'platform_setting', '', '\\Platform\\Setting\\Model\\SettingTable')
, ('platform_storage_adapter', '', '0', 'platform_storage', '', '\\Platform\\Storage\\Model\\StorageAdapterTable')
, ('platform_storage_file', '', '0', 'platform_storage', '', '\\Platform\\Storage\\Model\\StorageFileTable')
, ('platform_storage_file_tmp', '', '0', 'platform_storage', '', '\\Platform\\Storage\\Model\\StorageFileTmpTable')
, ('platform_storage', '', '0', 'platform_storage', '', '\\Platform\\Storage\\Model\\StorageTable')
, ('platform_user_attribute_value', '', '0', 'platform_user', '', '\\Platform\\User\\Model\\UserAttributeValueTable')
, ('platform_user_auth_password', '', '0', 'platform_user', '', '\\Platform\\User\\Model\\UserAuthPasswordTable')
, ('platform_user_auth_remote', '', '0', 'platform_user', '', '\\Platform\\User\\Model\\UserAuthRemoteTable')
, ('platform_user', '', '0', 'platform_user', '', '\\Platform\\User\\Model\\UserTable')
, ('platform_user_token', '', '0', 'platform_user', '', '\\Platform\\User\\Model\\UserTokenTable')
, ('base_blog_category', '', '0', 'base_blog', '', '\\Base\\Blog\\Model\\BlogCategoryTable')
, ('base_blog_post', '', '0', 'base_blog', '', '\\Base\\Blog\\Model\\BlogPostTable')
, ('base_comment', '', '0', 'base_comment', '', '\\Base\\Comment\\Model\\CommentTable')
, ('base_event_category', '', '0', 'base_event', '', '\\Base\\Event\\Model\\EventCategoryTable')
, ('base_event', '', '0', 'base_event', '', '\\Base\\Event\\Model\\EventTable')
, ('base_feed_hash', '', '0', 'base_feed', '', '\\Base\\Feed\\Model\\FeedHashTable')
, ('base_feed_hashtag', '', '0', 'base_feed', '', '\\Base\\Feed\\Model\\FeedHashtagTable')
, ('base_feed_hidden', '', '0', 'base_feed', '', '\\Base\\Feed\\Model\\FeedHiddenTable')
, ('base_feed_status', '', '0', 'base_feed', '', '\\Base\\Feed\\Model\\FeedStatusTable')
, ('base_feed_stream', '', '0', 'base_feed', '', '\\Base\\Feed\\Model\\FeedStreamTable')
, ('base_feed', '', '0', 'base_feed', '', '\\Base\\Feed\\Model\\FeedTable')
, ('base_feed_type', '', '0', 'base_feed', '', '\\Base\\Feed\\Model\\FeedTypeTable')
, ('base_follow', '', '0', 'base_follow', '', '\\Base\\Follow\\Model\\FollowTable')
, ('base_group_category', '', '0', 'base_group', '', '\\Base\\Group\\Model\\GroupCategoryTable')
, ('base_group', '', '0', 'base_group', '', '\\Base\\Group\\Model\\GroupTable')
, ('base_help_category', '', '0', 'base_help', '', '\\Base\\Help\\Model\\HelpCategoryTable')
, ('base_help_page', '', '0', 'base_help', '', '\\Base\\Help\\Model\\HelpPageTable')
, ('base_help_post', '', '0', 'base_help', '', '\\Base\\Help\\Model\\HelpPostTable')
, ('base_help_topic', '', '0', 'base_help', '', '\\Base\\Help\\Model\\HelpTopicTable')
, ('base_like', '', '0', 'base_like', '', '\\Base\\Like\\Model\\LikeTable')
, ('base_link', '', '0', 'base_link', '', '\\Base\\Link\\Model\\LinkTable')
, ('base_conversation', '', '0', 'base_message', '', '\\Base\\Message\\Model\\ConversationTable')
, ('base_message_conversation', '', '0', 'base_message', '', '\\Base\\Message\\Model\\MessageConversationTable')
, ('base_message_message', '', '0', 'base_message', '', '\\Base\\Message\\Model\\MessageMessageTable')
, ('base_message_recipient', '', '0', 'base_message', '', '\\Base\\Message\\Model\\MessageRecipientTable')
, ('base_message', '', '0', 'base_message', '', '\\Base\\Message\\Model\\MessageTable')
, ('base_recipient', '', '0', 'base_message', '', '\\Base\\Message\\Model\\RecipientTable')
, ('base_page_category', '', '0', 'base_page', '', '\\Base\\Page\\Model\\PageCategoryTable')
, ('base_page', '', '0', 'base_page', '', '\\Base\\Page\\Model\\PageTable')
, ('base_place', '', '0', 'base_place', '', '\\Base\\Place\\Model\\PlaceTable')
, ('base_report_category', '', '0', 'base_report', '', '\\Base\\Report\\Model\\ReportCategoryTable')
, ('base_report_general', '', '0', 'base_report', '', '\\Base\\Report\\Model\\ReportGeneralTable')
, ('base_report', '', '0', 'base_report', '', '\\Base\\Report\\Model\\ReportTable')
, ('base_review', '', '0', 'base_review', '', '\\Base\\Review\\Model\\ReviewTable')
, ('base_share', '', '0', 'base_share', '', '\\Base\\Share\\Model\\ShareTable')
, ('base_social_service', '', '0', 'base_social', '', '\\Base\\Social\\Model\\SocialServiceTable')
, ('base_tag_people', '', '0', 'base_tag', '', '\\Base\\Tag\\Model\\TagPeopleTable')
, ('base_video_category', '', '0', 'base_video', '', '\\Base\\Video\\Model\\VideoCategoryTable')
, ('base_video_playlist', '', '0', 'base_video', '', '\\Base\\Video\\Model\\VideoPlaylistTable')
, ('base_video_playlist_video', '', '0', 'base_video', '', '\\Base\\Video\\Model\\VideoPlaylistVideoTable')
, ('base_video', '', '0', 'base_video', '', '\\Base\\Video\\Model\\VideoTable')