<?php
/**
* @package phpBB Extension - Horizontal Attachments
* @copyright (c) 2024 Sniper_E - https://www.sniper-e.net
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*/

namespace sniper\horizontal\migrations\horizontal_install;

use phpbb\db\migration\container_aware_migration;

class m1_initial_file extends container_aware_migration
{
	static public function depends_on()
	{
		return ['\phpbb\db\migration\data\v330\v330'];
	}

	public function update_data()
	{
		$this->revert = false;
		return [
			['custom', [[$this, 'update_files']]],
		];
	}

	public function revert_data()
	{
		$this->revert = true;
		return [
			['custom', [[$this, 'update_files']]],
		];
	}

	public function update_files()
	{
		if (class_exists('dmzx\editor\editor'))
		{
			if (!$this->container->has('dmzx.editor'))
			{
				$dmzx_editor = new \dmzx\editor\editor(
					$this->container->get('user'),
					$this->container->get('log'),
					$this->phpbb_root_path
				);
				$this->container->set('dmzx.editor', $dmzx_editor);
			}
			$this->container->get('dmzx.editor')->update_files($this->data(), $this->revert);
		}
		else
		{
			$this->container->get('user')->add_lang_ext('sniper/horizontal', 'info_acp_horizontal');
			trigger_error($this->container->get('user')->lang['EDITOR_NOTICE'], E_USER_WARNING);
		}
	}

	public function data()
	{
		$replacements = [
			'files' => [
				0 => 'styles/prosilver/template/viewtopic_body.html',
				1 => 'styles/prosilver/template/posting_preview.html',
				2 => 'styles/prosilver/template/posting_review.html',
				3 => 'styles/prosilver/template/mcp_post.html',
				4 => 'styles/prosilver/template/attachment.html',
				5 => 'styles/prosilver/template/bbcode.html',
				6 => 'styles/prosilver/theme/content.css',
			],

			'searches' => [
				0 => [
					0 => '				<dl class="attachbox">
					<dt>
						{L_ATTACHMENTS}
					</dt>
					<!-- BEGIN attachment -->
						<dd>{postrow.attachment.DISPLAY_ATTACHMENT}</dd>
					<!-- END attachment -->
				</dl>',
				],
				1 => [
					0 => '				<dl class="attachbox">
					<dt>
						{L_ATTACHMENTS}
					</dt>
					<!-- BEGIN attachment -->
						<dd>{postrow.attachment.DISPLAY_ATTACHMENT}</dd>
					<!-- END attachment -->
				</dl>',
				],
				2 => [
					0 => '			<dl class="attachbox">
				<dt>{L_ATTACHMENTS}</dt>
				<!-- BEGIN attachment -->
					<dd>{post_review_row.attachment.DISPLAY_ATTACHMENT}</dd>
				<!-- END attachment -->
			</dl>',
				],
				3 => [
					0 => '			<dl class="attachbox">
				<dt>{L_ATTACHMENTS}</dt>
				<!-- BEGIN attachment -->
					<dd>{attachment.DISPLAY_ATTACHMENT}</dd>
				<!-- END attachment -->
			</dl>',
				],
				4 => [
					0 => '		<!-- IF _file.S_THUMBNAIL -->
		<dl class="thumbnail">
			<dt><a href="{_file.U_DOWNLOAD_LINK}"><img src="{_file.THUMB_IMAGE}" class="postimage" alt="{% if _file.COMMENT %}{{ _file.COMMENT|e(\'html\') }}{% else %}{{ _file.DOWNLOAD_NAME }}{% endif %}" title="{_file.DOWNLOAD_NAME} ({_file.FILESIZE} {_file.SIZE_LANG}) {_file.L_DOWNLOAD_COUNT}" /></a></dt>
			<!-- IF _file.COMMENT --><dd> {_file.COMMENT}</dd><!-- ENDIF -->
		</dl>
		<!-- ENDIF -->

		<!-- IF _file.S_IMAGE -->
		<dl class="file">
			<dt class="attach-image"><img src="{_file.U_INLINE_LINK}" class="postimage" alt="{% if _file.COMMENT %}{{ _file.COMMENT|e(\'html\') }}{% else %}{{ _file.DOWNLOAD_NAME }}{% endif %}" onclick="viewableArea(this);" /></dt>
			<!-- IF _file.COMMENT --><dd><em>{_file.COMMENT}</em></dd><!-- ENDIF -->
			<dd>{_file.DOWNLOAD_NAME} ({_file.FILESIZE} {_file.SIZE_LANG}) {_file.L_DOWNLOAD_COUNT}</dd>
		</dl>
		<!-- ENDIF -->

		<!-- IF _file.S_FILE -->
		<dl class="file">
			<dt><!-- IF _file.UPLOAD_ICON -->{_file.UPLOAD_ICON} <!-- ENDIF --><a class="postlink" href="{_file.U_DOWNLOAD_LINK}">{_file.DOWNLOAD_NAME}</a></dt>
			<!-- IF _file.COMMENT --><dd><em>{_file.COMMENT}</em></dd><!-- ENDIF -->
			<dd>({_file.FILESIZE} {_file.SIZE_LANG}) {_file.L_DOWNLOAD_COUNT}</dd>
		</dl>
		<!-- ENDIF -->',
				],
				5 => [
					0 => '<!-- BEGIN inline_attachment_open --><div class="inline-attachment"><!-- END inline_attachment_open -->
<!-- BEGIN inline_attachment_close --></div><!-- END inline_attachment_close -->',
				],
				6 => [
					0 => '/* Inline image thumbnails */',
				]
			],

			'replaces' => [
				0 => [
					0 => '				<h3>{L_ATTACHMENTS}</h3>
				<!-- BEGIN attachment -->
				{postrow.attachment.DISPLAY_ATTACHMENT}
				<!-- END attachment -->',
				],
				1 => [
					0 => '		<h3>{L_ATTACHMENTS}</h3>
		<!-- BEGIN attachment -->
		{attachment.DISPLAY_ATTACHMENT}
		<!-- END attachment -->',
				],
				2 => [
					0 => '			<h3>{L_ATTACHMENTS}</h3>
			<!-- BEGIN attachment -->
			{post_review_row.attachment.DISPLAY_ATTACHMENT}
			<!-- END attachment -->',
				],
				3 => [
					0 => '			<h3>{L_ATTACHMENTS}</h3>
			<!-- BEGIN attachment -->
			{attachment.DISPLAY_ATTACHMENT}
			<!-- END attachment -->',
				],
				4 => [
					0 => '		<!-- IF _file.S_THUMBNAIL -->
		<div class="thumbnail">
			<a href="{_file.U_DOWNLOAD_LINK}"><img src="{_file.THUMB_IMAGE}" alt="{% if _file.COMMENT %}{{ _file.COMMENT|e(\'html\') }}{% else %}{{ _file.DOWNLOAD_NAME }}{% endif %}" title="{_file.DOWNLOAD_NAME} ({_file.FILESIZE} {_file.SIZE_LANG}) {_file.L_DOWNLOAD_COUNT}" /></a>
			<!-- IF _file.COMMENT --><br /><em>{_file.COMMENT}</em><!-- ENDIF -->
		</div>
		<!-- ENDIF -->

		<!-- IF _file.S_IMAGE -->
		<div class="file">
			<img src="{_file.U_INLINE_LINK}" alt="{% if _file.COMMENT %}{{ _file.COMMENT|e(\'html\') }}{% else %}{{ _file.DOWNLOAD_NAME }}{% endif %}" onclick="viewableArea(this);" />
			<!-- IF _file.COMMENT --><br /><em>{_file.COMMENT}</em><!-- ENDIF -->
			<br />{_file.DOWNLOAD_NAME} ({_file.FILESIZE} {_file.SIZE_LANG})<br />{_file.L_DOWNLOAD_COUNT}
		</div>
		<!-- ENDIF -->

		<!-- IF _file.S_FILE -->
		<div class="file">
			<!-- IF _file.UPLOAD_ICON -->{_file.UPLOAD_ICON} <!-- ENDIF --><a class="postlink" href="{_file.U_DOWNLOAD_LINK}">{_file.DOWNLOAD_NAME}</a>
			<!-- IF _file.COMMENT --><br /><em>{_file.COMMENT}</em><!-- ENDIF -->
			<br />({_file.FILESIZE} {_file.SIZE_LANG})<br />{_file.L_DOWNLOAD_COUNT}
		</div>
		<!-- ENDIF -->',
				],
				5 => [
					0 => '<!-- BEGIN inline_attachment_open --><table><tr><td><!-- END inline_attachment_open -->
<!-- BEGIN inline_attachment_close --></td></tr></table><!-- END inline_attachment_close -->',
				],
				6 => [
					0 => '/* Horizontal attachments */
div.thumbnail {
	float: left;
	padding: 4px 4px 2px;
	text-align: center;
	margin: 4px 4px 4px 0;
}
div.thumbnail img {
	padding: 2px;
	background-color: #C79360;
	border: 2px solid #9A5614;
}
div.file {
	float: left;
	padding: 4px 4px 2px;
	background-color: #cadceb;
	border: 1px solid #A5C1D8;
	margin: 4px 4px 4px 0;
}

/* Inline image thumbnails */',
				]
			],
/****************************************************************************/
		];
		return $replacements;
	}
}
