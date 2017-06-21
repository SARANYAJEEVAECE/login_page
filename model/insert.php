<?php 
	
	function insert($table_name, $column_names, $column_values, $con){
		$sql = get_insert_query($table_name, $column_names, $column_values);
		// echo $sql;	
		if(execute_query($sql, $con) == 1){
			return "inserted";
		}else{
			return "error";
		}
	}

	function get_insert_query($table_name, $column_names, $column_values){
		$column_name = parse_insert_column_name($column_names);
		$column_value = parse_insert_column_values($column_values);
		$query = "INSERT INTO ".$table_name." (".$column_name.") VALUES (".$column_value.")";
		return $query;
		// echo $query;
	}

	function parse_insert_column_name($column_names){
		if(is__array($column_names)){
			$i = 1;
			foreach ($column_names as $key => $column_name) {
				if($i == 1){
					$colum_sql = "`".$column_name."`";
					++$i;
				} else{
					$colum_sql = $colum_sql.", `".$column_name."`";
				}
			}
		} else{
			$colum_sql = "`".$column_names."`";
		}
		return $colum_sql;
	}

	function parse_insert_column_values($column_values){
		if(is__array($column_values)){
			$i = 1;
			foreach ($column_values as $key => $column_value) {
				if($i == 1){
					$colum_sql = '"'.$column_value.'"';
					++$i;
				} else{
					$colum_sql = $colum_sql.', "'.$column_value.'"';
				}
			}
		} else{
			$colum_sql = "`".$column_values."`";
		}
		return $colum_sql;
	}
	