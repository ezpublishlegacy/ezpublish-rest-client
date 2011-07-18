CREATE TABLE 'ezbinaryfile' (
	'contentobject_attribute_id' integer NOT NULL DEFAULT 0,
	'download_count' integer NOT NULL DEFAULT 0,
	'filename' text(255) NOT NULL,
	'mime_type' text(255) NOT NULL,
	'original_filename' text(255) NOT NULL,
	'version' integer NOT NULL DEFAULT 0
);
CREATE TABLE 'ezcontent_language' (
	'disabled' integer NOT NULL DEFAULT 0,
	'id' integer NOT NULL DEFAULT 0,
	'locale' text(20) NOT NULL,
	'name' text(255) NOT NULL
);
CREATE TABLE 'ezcontentclass' (
	'always_available' integer NOT NULL DEFAULT 0,
	'contentobject_name' text(255),
	'created' integer NOT NULL DEFAULT 0,
	'creator_id' integer NOT NULL DEFAULT 0,
	'id' integer NOT NULL PRIMARY KEY AUTOINCREMENT,
	'identifier' text(50) NOT NULL,
	'initial_language_id' integer NOT NULL DEFAULT 0,
	'is_container' integer NOT NULL DEFAULT 0,
	'language_mask' integer NOT NULL DEFAULT 0,
	'modified' integer NOT NULL DEFAULT 0,
	'modifier_id' integer NOT NULL DEFAULT 0,
	'remote_id' text(100) NOT NULL,
	'serialized_description_list' clob,
	'serialized_name_list' clob,
	'sort_field' integer NOT NULL DEFAULT 1,
	'sort_order' integer NOT NULL DEFAULT 1,
	'url_alias_name' text(255),
	'version' integer NOT NULL DEFAULT 0
);
CREATE TABLE 'ezcontentclass_attribute' (
	'can_translate' integer DEFAULT 1,
	'category' text(25) NOT NULL,
	'contentclass_id' integer NOT NULL DEFAULT 0,
	'data_float1' real,
	'data_float2' real,
	'data_float3' real,
	'data_float4' real,
	'data_int1' integer,
	'data_int2' integer,
	'data_int3' integer,
	'data_int4' integer,
	'data_text1' text(50),
	'data_text2' text(50),
	'data_text3' text(50),
	'data_text4' text(255),
	'data_text5' clob,
	'data_type_string' text(50) NOT NULL,
	'id' integer NOT NULL PRIMARY KEY AUTOINCREMENT,
	'identifier' text(50) NOT NULL,
	'is_information_collector' integer NOT NULL DEFAULT 0,
	'is_required' integer NOT NULL DEFAULT 0,
	'is_searchable' integer NOT NULL DEFAULT 0,
	'placement' integer NOT NULL DEFAULT 0,
	'serialized_data_text' clob,
	'serialized_description_list' clob,
	'serialized_name_list' clob NOT NULL,
	'version' integer NOT NULL DEFAULT 0
);
CREATE TABLE 'ezcontentclass_classgroup' (
	'contentclass_id' integer NOT NULL DEFAULT 0,
	'contentclass_version' integer NOT NULL DEFAULT 0,
	'group_id' integer NOT NULL DEFAULT 0,
	'group_name' text(255)
);
CREATE TABLE 'ezcontentclass_name' (
	'contentclass_id' integer NOT NULL DEFAULT 0,
	'contentclass_version' integer NOT NULL DEFAULT 0,
	'language_id' integer NOT NULL DEFAULT 0,
	'language_locale' text(20) NOT NULL,
	'name' text(255) NOT NULL
);
CREATE TABLE 'ezcontentclassgroup' (
	'created' integer NOT NULL DEFAULT 0,
	'creator_id' integer NOT NULL DEFAULT 0,
	'id' integer NOT NULL PRIMARY KEY AUTOINCREMENT,
	'modified' integer NOT NULL DEFAULT 0,
	'modifier_id' integer NOT NULL DEFAULT 0,
	'name' text(255)
);
CREATE TABLE 'ezcontentobject' (
	'contentclass_id' integer NOT NULL DEFAULT 0,
	'current_version' integer,
	'id' integer NOT NULL PRIMARY KEY AUTOINCREMENT,
	'initial_language_id' integer NOT NULL DEFAULT 0,
	'language_mask' integer NOT NULL DEFAULT 0,
	'modified' integer NOT NULL DEFAULT 0,
	'name' text(255),
	'owner_id' integer NOT NULL DEFAULT 0,
	'published' integer NOT NULL DEFAULT 0,
	'remote_id' text(100),
	'section_id' integer NOT NULL DEFAULT 0,
	'status' integer DEFAULT 0
);
CREATE TABLE 'ezcontentobject_attribute' (
	'attribute_original_id' integer DEFAULT 0,
	'contentclassattribute_id' integer NOT NULL DEFAULT 0,
	'contentobject_id' integer NOT NULL DEFAULT 0,
	'data_float' real,
	'data_int' integer,
	'data_text' clob,
	'data_type_string' text(50),
	'id' integer NOT NULL PRIMARY KEY AUTOINCREMENT,
	'language_code' text(20) NOT NULL,
	'language_id' integer NOT NULL DEFAULT 0,
	'sort_key_int' integer NOT NULL DEFAULT 0,
	'sort_key_string' text(255) NOT NULL,
	'version' integer NOT NULL DEFAULT 0
);
CREATE TABLE 'ezcontentobject_link' (
	'contentclassattribute_id' integer NOT NULL DEFAULT 0,
	'from_contentobject_id' integer NOT NULL DEFAULT 0,
	'from_contentobject_version' integer NOT NULL DEFAULT 0,
	'id' integer NOT NULL PRIMARY KEY AUTOINCREMENT,
	'op_code' integer NOT NULL DEFAULT 0,
	'relation_type' integer NOT NULL DEFAULT 1,
	'to_contentobject_id' integer NOT NULL DEFAULT 0
);
CREATE TABLE 'ezcontentobject_name' (
	'content_translation' text(20) NOT NULL,
	'content_version' integer NOT NULL DEFAULT 0,
	'contentobject_id' integer NOT NULL DEFAULT 0,
	'language_id' integer NOT NULL DEFAULT 0,
	'name' text(255),
	'real_translation' text(20)
);
CREATE TABLE 'ezcontentobject_trash' (
	'contentobject_id' integer,
	'contentobject_version' integer,
	'depth' integer NOT NULL DEFAULT 0,
	'is_hidden' integer NOT NULL DEFAULT 0,
	'is_invisible' integer NOT NULL DEFAULT 0,
	'main_node_id' integer,
	'modified_subnode' integer DEFAULT 0,
	'node_id' integer NOT NULL DEFAULT 0,
	'parent_node_id' integer NOT NULL DEFAULT 0,
	'path_identification_string' clob,
	'path_string' text(255) NOT NULL,
	'priority' integer NOT NULL DEFAULT 0,
	'remote_id' text(100) NOT NULL,
	'sort_field' integer DEFAULT 1,
	'sort_order' integer DEFAULT 1
);
CREATE TABLE 'ezcontentobject_tree' (
	'contentobject_id' integer,
	'contentobject_is_published' integer,
	'contentobject_version' integer,
	'depth' integer NOT NULL DEFAULT 0,
	'is_hidden' integer NOT NULL DEFAULT 0,
	'is_invisible' integer NOT NULL DEFAULT 0,
	'main_node_id' integer,
	'modified_subnode' integer DEFAULT 0,
	'node_id' integer NOT NULL PRIMARY KEY AUTOINCREMENT,
	'parent_node_id' integer NOT NULL DEFAULT 0,
	'path_identification_string' clob,
	'path_string' text(255) NOT NULL,
	'priority' integer NOT NULL DEFAULT 0,
	'remote_id' text(100) NOT NULL,
	'sort_field' integer DEFAULT 1,
	'sort_order' integer DEFAULT 1
);
CREATE TABLE 'ezcontentobject_version' (
	'contentobject_id' integer,
	'created' integer NOT NULL DEFAULT 0,
	'creator_id' integer NOT NULL DEFAULT 0,
	'id' integer NOT NULL PRIMARY KEY AUTOINCREMENT,
	'initial_language_id' integer NOT NULL DEFAULT 0,
	'language_mask' integer NOT NULL DEFAULT 0,
	'modified' integer NOT NULL DEFAULT 0,
	'status' integer NOT NULL DEFAULT 0,
	'user_id' integer NOT NULL DEFAULT 0,
	'version' integer NOT NULL DEFAULT 0,
	'workflow_event_pos' integer DEFAULT 0
);
CREATE TABLE 'eznode_assignment' (
	'contentobject_id' integer,
	'contentobject_version' integer,
	'from_node_id' integer DEFAULT 0,
	'id' integer NOT NULL PRIMARY KEY AUTOINCREMENT,
	'is_main' integer NOT NULL DEFAULT 0,
	'op_code' integer NOT NULL DEFAULT 0,
	'parent_node' integer,
	'parent_remote_id' text(100) NOT NULL,
	'remote_id' integer NOT NULL DEFAULT 0,
	'sort_field' integer DEFAULT 1,
	'sort_order' integer DEFAULT 1
);
CREATE TABLE 'ezpolicy' (
	'function_name' text(255),
	'id' integer NOT NULL PRIMARY KEY AUTOINCREMENT,
	'module_name' text(255),
	'original_id' integer NOT NULL DEFAULT 0,
	'role_id' integer
);
CREATE TABLE 'ezpolicy_limitation' (
	'id' integer NOT NULL PRIMARY KEY AUTOINCREMENT,
	'identifier' text(255) NOT NULL,
	'policy_id' integer
);
CREATE TABLE 'ezpolicy_limitation_value' (
	'id' integer NOT NULL PRIMARY KEY AUTOINCREMENT,
	'limitation_id' integer,
	'value' text(255)
);
CREATE TABLE 'ezrole' (
	'id' integer NOT NULL PRIMARY KEY AUTOINCREMENT,
	'is_new' integer NOT NULL DEFAULT 0,
	'name' text(255) NOT NULL,
	'value' text(1),
	'version' integer DEFAULT 0
);
CREATE TABLE 'ezurl' (
	'created' integer NOT NULL DEFAULT 0,
	'id' integer NOT NULL PRIMARY KEY AUTOINCREMENT,
	'is_valid' integer NOT NULL DEFAULT 1,
	'last_checked' integer NOT NULL DEFAULT 0,
	'modified' integer NOT NULL DEFAULT 0,
	'original_url_md5' text(32) NOT NULL,
	'url' clob
);
CREATE TABLE 'ezurl_object_link' (
	'contentobject_attribute_id' integer NOT NULL DEFAULT 0,
	'contentobject_attribute_version' integer NOT NULL DEFAULT 0,
	'url_id' integer NOT NULL DEFAULT 0
);
CREATE TABLE 'ezurlalias' (
	'destination_url' clob NOT NULL,
	'forward_to_id' integer NOT NULL DEFAULT 0,
	'id' integer NOT NULL PRIMARY KEY AUTOINCREMENT,
	'is_imported' integer NOT NULL DEFAULT 0,
	'is_internal' integer NOT NULL DEFAULT 1,
	'is_wildcard' integer NOT NULL DEFAULT 0,
	'source_md5' text(32),
	'source_url' clob NOT NULL
);
CREATE TABLE 'ezurlalias_ml' (
	'action' clob NOT NULL,
	'action_type' text(32) NOT NULL,
	'alias_redirects' integer NOT NULL DEFAULT 1,
	'id' integer NOT NULL DEFAULT 0,
	'is_alias' integer NOT NULL DEFAULT 0,
	'is_original' integer NOT NULL DEFAULT 0,
	'lang_mask' integer NOT NULL DEFAULT 0,
	'link' integer NOT NULL DEFAULT 0,
	'parent' integer NOT NULL DEFAULT 0,
	'text' clob NOT NULL,
	'text_md5' text(32) NOT NULL
);
CREATE TABLE 'ezurlalias_ml_incr' (
	'id' integer NOT NULL PRIMARY KEY AUTOINCREMENT
);
CREATE TABLE 'ezuser' (
	'contentobject_id' integer NOT NULL DEFAULT 0,
	'email' text(150) NOT NULL,
	'login' text(150) NOT NULL,
	'password_hash' text(50),
	'password_hash_type' integer NOT NULL DEFAULT 1
);
CREATE TABLE 'ezuser_role' (
	'contentobject_id' integer,
	'id' integer NOT NULL PRIMARY KEY AUTOINCREMENT,
	'limit_identifier' text(255),
	'limit_value' text(255),
	'role_id' integer
);
CREATE TABLE 'ezuser_setting' (
	'is_enabled' integer NOT NULL DEFAULT 0,
	'max_login' integer,
	'user_id' integer NOT NULL DEFAULT 0
);
CREATE UNIQUE INDEX 'ezbinaryfile_pri' ON 'ezbinaryfile' ( 'contentobject_attribute_id', 'version' );
CREATE INDEX 'ezco_link_from' ON 'ezcontentobject_link' ( 'from_contentobject_id', 'from_contentobject_version', 'contentclassattribute_id' );
CREATE INDEX 'ezco_link_to_co_id' ON 'ezcontentobject_link' ( 'to_contentobject_id' );
CREATE INDEX 'ezcobj_trash_co_id' ON 'ezcontentobject_trash' ( 'contentobject_id' );
CREATE INDEX 'ezcobj_trash_depth' ON 'ezcontentobject_trash' ( 'depth' );
CREATE INDEX 'ezcobj_trash_modified_subnode' ON 'ezcontentobject_trash' ( 'modified_subnode' );
CREATE INDEX 'ezcobj_trash_p_node_id' ON 'ezcontentobject_trash' ( 'parent_node_id' );
CREATE INDEX 'ezcobj_trash_path' ON 'ezcontentobject_trash' ( 'path_string' );
CREATE INDEX 'ezcobj_trash_path_ident' ON 'ezcontentobject_trash' ( 'path_identification_string' );
CREATE INDEX 'ezcobj_version_creator_id' ON 'ezcontentobject_version' ( 'creator_id' );
CREATE INDEX 'ezcobj_version_status' ON 'ezcontentobject_version' ( 'status' );
CREATE INDEX 'ezcontent_language_name' ON 'ezcontent_language' ( 'name' );
CREATE UNIQUE INDEX 'ezcontent_language_pri' ON 'ezcontent_language' ( 'id' );
CREATE INDEX 'ezcontentclass_attr_ccid' ON 'ezcontentclass_attribute' ( 'contentclass_id' );
CREATE UNIQUE INDEX 'ezcontentclass_classgroup_pri' ON 'ezcontentclass_classgroup' ( 'contentclass_id', 'contentclass_version', 'group_id' );
CREATE UNIQUE INDEX 'ezcontentclass_name_pri' ON 'ezcontentclass_name' ( 'contentclass_id', 'contentclass_version', 'language_id' );
CREATE INDEX 'ezcontentclass_version' ON 'ezcontentclass' ( 'version' );
CREATE INDEX 'ezcontentobject_attr_id' ON 'ezcontentobject_attribute' ( 'id' );
CREATE INDEX 'ezcontentobject_attribute_co_id_ver_lang_code' ON 'ezcontentobject_attribute' ( 'contentobject_id', 'version', 'language_code' );
CREATE INDEX 'ezcontentobject_attribute_contentobject_id' ON 'ezcontentobject_attribute' ( 'contentobject_id' );
CREATE INDEX 'ezcontentobject_attribute_language_code' ON 'ezcontentobject_attribute' ( 'language_code' );
CREATE INDEX 'ezcontentobject_classid' ON 'ezcontentobject' ( 'contentclass_id' );
CREATE INDEX 'ezcontentobject_currentversion' ON 'ezcontentobject' ( 'current_version' );
CREATE INDEX 'ezcontentobject_lmask' ON 'ezcontentobject' ( 'language_mask' );
CREATE INDEX 'ezcontentobject_name_co_id' ON 'ezcontentobject_name' ( 'contentobject_id' );
CREATE INDEX 'ezcontentobject_name_cov_id' ON 'ezcontentobject_name' ( 'content_version' );
CREATE INDEX 'ezcontentobject_name_lang_id' ON 'ezcontentobject_name' ( 'language_id' );
CREATE INDEX 'ezcontentobject_name_name' ON 'ezcontentobject_name' ( 'name' );
CREATE UNIQUE INDEX 'ezcontentobject_name_pri' ON 'ezcontentobject_name' ( 'contentobject_id', 'content_version', 'content_translation' );
CREATE INDEX 'ezcontentobject_owner' ON 'ezcontentobject' ( 'owner_id' );
CREATE INDEX 'ezcontentobject_pub' ON 'ezcontentobject' ( 'published' );
CREATE UNIQUE INDEX 'ezcontentobject_remote_id' ON 'ezcontentobject' ( 'remote_id' );
CREATE INDEX 'ezcontentobject_status' ON 'ezcontentobject' ( 'status' );
CREATE UNIQUE INDEX 'ezcontentobject_trash_pri' ON 'ezcontentobject_trash' ( 'node_id' );
CREATE INDEX 'ezcontentobject_tree_co_id' ON 'ezcontentobject_tree' ( 'contentobject_id' );
CREATE INDEX 'ezcontentobject_tree_depth' ON 'ezcontentobject_tree' ( 'depth' );
CREATE INDEX 'ezcontentobject_tree_p_node_id' ON 'ezcontentobject_tree' ( 'parent_node_id' );
CREATE INDEX 'ezcontentobject_tree_path' ON 'ezcontentobject_tree' ( 'path_string' );
CREATE INDEX 'ezcontentobject_tree_path_ident' ON 'ezcontentobject_tree' ( 'path_identification_string' );
CREATE INDEX 'eznode_assignment_co_id' ON 'eznode_assignment' ( 'contentobject_id' );
CREATE INDEX 'eznode_assignment_co_version' ON 'eznode_assignment' ( 'contentobject_version' );
CREATE INDEX 'eznode_assignment_coid_cov' ON 'eznode_assignment' ( 'contentobject_id', 'contentobject_version' );
CREATE INDEX 'eznode_assignment_is_main' ON 'eznode_assignment' ( 'is_main' );
CREATE INDEX 'eznode_assignment_parent_node' ON 'eznode_assignment' ( 'parent_node' );
CREATE INDEX 'ezpolicy_limitation_value_val' ON 'ezpolicy_limitation_value' ( 'value' );
CREATE INDEX 'ezpolicy_original_id' ON 'ezpolicy' ( 'original_id' );
CREATE INDEX 'ezurl_ol_coa_id' ON 'ezurl_object_link' ( 'contentobject_attribute_id' );
CREATE INDEX 'ezurl_ol_coa_version' ON 'ezurl_object_link' ( 'contentobject_attribute_version' );
CREATE INDEX 'ezurl_ol_url_id' ON 'ezurl_object_link' ( 'url_id' );
CREATE INDEX 'ezurl_url' ON 'ezurl' ( 'url' );
CREATE INDEX 'ezurlalias_desturl' ON 'ezurlalias' ( 'destination_url' );
CREATE INDEX 'ezurlalias_forward_to_id' ON 'ezurlalias' ( 'forward_to_id' );
CREATE INDEX 'ezurlalias_imp_wcard_fwd' ON 'ezurlalias' ( 'is_imported', 'is_wildcard', 'forward_to_id' );
CREATE INDEX 'ezurlalias_ml_act_org' ON 'ezurlalias_ml' ( 'action', 'is_original' );
CREATE INDEX 'ezurlalias_ml_action' ON 'ezurlalias_ml' ( 'action', 'id', 'link' );
CREATE INDEX 'ezurlalias_ml_actt' ON 'ezurlalias_ml' ( 'action_type' );
CREATE INDEX 'ezurlalias_ml_actt_org_al' ON 'ezurlalias_ml' ( 'action_type', 'is_original', 'is_alias' );
CREATE INDEX 'ezurlalias_ml_id' ON 'ezurlalias_ml' ( 'id' );
CREATE INDEX 'ezurlalias_ml_par_act_id_lnk' ON 'ezurlalias_ml' ( 'parent', 'action', 'id', 'link' );
CREATE INDEX 'ezurlalias_ml_par_lnk_txt' ON 'ezurlalias_ml' ( 'parent', 'link', 'text' );
CREATE INDEX 'ezurlalias_ml_par_txt' ON 'ezurlalias_ml' ( 'parent', 'text' );
CREATE UNIQUE INDEX 'ezurlalias_ml_pri' ON 'ezurlalias_ml' ( 'parent', 'text_md5' );
CREATE INDEX 'ezurlalias_ml_text' ON 'ezurlalias_ml' ( 'text', 'id', 'link' );
CREATE INDEX 'ezurlalias_ml_text_lang' ON 'ezurlalias_ml' ( 'text', 'lang_mask', 'parent' );
CREATE INDEX 'ezurlalias_source_md5' ON 'ezurlalias' ( 'source_md5' );
CREATE INDEX 'ezurlalias_source_url' ON 'ezurlalias' ( 'source_url' );
CREATE INDEX 'ezurlalias_wcard_fwd' ON 'ezurlalias' ( 'is_wildcard', 'forward_to_id' );
CREATE UNIQUE INDEX 'ezuser_pri' ON 'ezuser' ( 'contentobject_id' );
CREATE INDEX 'ezuser_role_contentobject_id' ON 'ezuser_role' ( 'contentobject_id' );
CREATE INDEX 'ezuser_role_role_id' ON 'ezuser_role' ( 'role_id' );
CREATE UNIQUE INDEX 'ezuser_setting_pri' ON 'ezuser_setting' ( 'user_id' );
CREATE INDEX 'idx_object_version_objver' ON 'ezcontentobject_version' ( 'contentobject_id', 'version' );
CREATE INDEX 'modified_subnode' ON 'ezcontentobject_tree' ( 'modified_subnode' );
CREATE INDEX 'policy_id' ON 'ezpolicy_limitation' ( 'policy_id' );
CREATE INDEX 'sort_key_int' ON 'ezcontentobject_attribute' ( 'sort_key_int' );
CREATE INDEX 'sort_key_string' ON 'ezcontentobject_attribute' ( 'sort_key_string' );