			$('#TreasureMakers').ajaxChosen({
				type: 'GET',
				url: '/treasures/find.json',
				dataType: 'json',
				jsonTermKey: 'q',
				placeholder_text_single: 'pick stuff'
					}, function (data) {
						var results = [];
						$.each(data, function (i, val) {
							results.push({ value: val.value, text: val.text });
						});
				console.log ( results);
				return results;
					});