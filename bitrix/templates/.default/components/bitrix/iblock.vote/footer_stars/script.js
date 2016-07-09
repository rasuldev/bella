(function (window)
{
	if (!!window.JCFlatVote)
	{
		return;
	}

	window.JCFlatVote = {
		trace_vote: function (div, flag)
		{
			var my_div;
			//Left from current
			my_div = div;
			while (my_div = my_div.previousSibling)
			{
				if (flag)
					BX.addClass(my_div, 'bx-star-active');
				else
					BX.removeClass(my_div, 'bx-star-active');
			}
			//current
			if (flag)
				BX.addClass(div, 'bx-star-active');
			else
				BX.removeClass(div, 'bx-star-active');
			//Right from the current
			my_div = div;
			while (my_div = my_div.nextSibling)
			{
				BX.removeClass(my_div, 'bx-star-active');
			}
		},

		do_vote: function (div, parent_id, arParams)
		{
			console.log("do_vote");
			var r = div.id.match(/^vote_(\d+)_(\d+)$/);

			var vote_id = r[1];
			var vote_value = r[2];

			arParams['vote'] = 'Y';
			arParams['vote_id'] = vote_id;
			arParams['rating'] = vote_value;
			console.log(arParams);

			BX.ajax.post(
				'/bitrix/components/bitrix/iblock.vote/component.php',
				arParams,
				function (data)
				{
					var obContainer = document.getElementById(parent_id);
					if (obContainer)
					{
						var obResult = document.createElement('div');//BX.create('p');
						obResult.innerHTML = data;
						var parent = obContainer.parentNode;
						var newChild = obResult.firstChild;
						parent.replaceChild(newChild, obContainer);
					}
				}
			);
		}
	}
}
)(window);
