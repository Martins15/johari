<?php
class JohariModel extends CFormModel {
	public function getFeatures() {
		return Yii::app()->db->createCommand()->select('*')->from('features')->queryAll();
	}
	
	public function nameExists($name) {
		return (bool)Yii::app()->db->createCommand()->select('*')->from('names')->where('LCASE(name) = "' . strtolower($name) . '"')->queryRow();
	}
	
	public function getResults($name) {
		return Yii::app()->db->createCommand()->select('n.name, v.name AS voter, f.feature, f.feature_id')->from('relationships r')->join('names n', 'n.name_id = r.name')->join('names v', 'v.name_id = r.voter')->join('features f', 'f.feature_id = r.feature')->where('LCASE(n.name) = "' . strtolower($name) . '"')->queryAll();
	}
	
	public function getUnknown($exclude) {
		return Yii::app()->db->createCommand()->select('feature')->from('features')->where('feature NOT IN(' . $exclude . ')')->queryAll();
	}
	
	public function saveResults($data) {
		if (!$this->nameExists($data['voter'])) {
			Yii::app()->db->createCommand()->insert('names', array('name' => $data['voter']));
			$voter = Yii::app()->db->getLastInsertID();
		} else {
			$voter = Yii::app()->db->createCommand()->select('name_id')->from('names')->where('LCASE(name) = "' . strtolower($data['voter']) . '"')->queryRow();
			$voter = $voter['name_id'];
		}
		
		if (empty($data['name'])) {
			$name = $voter;
		} else {
			if (!$this->nameExists($data['name'])) {
				Yii::app()->db->createCommand()->insert('names', array('name' => $data['name']));
				$name = Yii::app()->db->getLastInsertID();
			} else {
				$name = Yii::app()->db->createCommand()->select('name_id')->from('names')->where('LCASE(name) = "' . strtolower($data['name']) . '"')->queryRow();
				$name = $name['name_id'];
			}
		}
		
		foreach (explode(',', $data['features']) as $feature) {
			Yii::app()->db->createCommand()->insert('relationships', array('name' => $name, 'feature' => $feature, 'voter' => $voter));
		}
	}
}