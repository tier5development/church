<?php
/**
 Admin Page Framework v3.5.12 by Michael Uno
 Generated by PHP Class Files Script Generator <https://github.com/michaeluno/PHP-Class-Files-Script-Generator>
 <http://en.michaeluno.jp/admin-page-framework>
 Copyright (c) 2013-2015, Michael Uno; Licensed under MIT <http://opensource.org/licenses/MIT>
 */
abstract class SeamlessDonationsAdminPageFramework_Form_View extends SeamlessDonationsAdminPageFramework_Form_Model {
    public function _replyToGetInputNameAttribute() {
        $_aParams = func_get_args() + array(null, null, null);
        $aField = $_aParams[1];
        $sKey = ( string )$_aParams[2];
        $sKey = $this->oUtil->getAOrB('0' !== $sKey && empty($sKey), '', "[{$sKey}]");
        $_sSectionIndex = isset($aField['section_id'], $aField['_section_index']) ? "[{$aField['_section_index']}]" : "";
        $_sSectionDimension = $this->isSectionSet($aField) ? "[{$aField['section_id']}]" : '';
        return "{$aField['option_key']}{$_sSectionDimension}{$_sSectionIndex}[{$aField['field_id']}]{$sKey}";
    }
    public function _replyToGetFlatInputName() {
        $_aParams = func_get_args() + array(null, null, null);
        $sFlatNameAttribute = $_aParams[0];
        $aField = $_aParams[1];
        $_sKey = ( string )$_aParams[2];
        $_sKey = $this->oUtil->getAOrB('0' !== $_sKey && empty($_sKey), '', "|{$_sKey}");
        $_sSectionIndex = isset($aField['section_id'], $aField['_section_index']) ? "[{$aField['_section_index']}]" : "";
        $_sSectionDimension = $this->isSectionSet($aField) ? "|{$aField['section_id']}" : '';
        return "{$aField['option_key']}{$_sSectionDimension}{$_sSectionIndex}|{$aField['field_id']}{$_sKey}";
    }
    public function _replyToGetSectionHeaderOutput($sSectionDescription, $aSection) {
        return $this->oUtil->addAndApplyFilters($this, array('section_head_' . $this->oProp->sClassName . '_' . $aSection['section_id']), $sSectionDescription);
    }
    public function _replyToGetFieldOutput($aField) {
        $_sCurrentPageSlug = $this->oProp->getCurrentPageSlug();
        $_sSectionID = $this->oUtil->getElement($aField, 'section_id', '_default');
        $_sFieldID = $aField['field_id'];
        if ($aField['page_slug'] != $_sCurrentPageSlug) {
            return '';
        }
        $this->aFieldErrors = isset($this->aFieldErrors) ? $this->aFieldErrors : $this->_getFieldErrors($_sCurrentPageSlug);
        $sFieldType = isset($this->oProp->aFieldTypeDefinitions[$aField['type']]['hfRenderField']) && is_callable($this->oProp->aFieldTypeDefinitions[$aField['type']]['hfRenderField']) ? $aField['type'] : 'default';
        $_aTemp = $this->getSavedOptions();
        $_oField = new SeamlessDonationsAdminPageFramework_FormField($aField, $_aTemp, $this->aFieldErrors, $this->oProp->aFieldTypeDefinitions, $this->oMsg, $this->oProp->aFieldCallbacks);
        $_sFieldOutput = $_oField->_getFieldOutput();
        unset($_oField);
        return $this->oUtil->addAndApplyFilters($this, array(isset($aField['section_id']) && '_default' !== $aField['section_id'] ? 'field_' . $this->oProp->sClassName . '_' . $aField['section_id'] . '_' . $_sFieldID : 'field_' . $this->oProp->sClassName . '_' . $_sFieldID,), $_sFieldOutput, $aField);
    }
}