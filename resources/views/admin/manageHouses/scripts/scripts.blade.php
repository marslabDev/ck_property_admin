<script>
    $(function () {
        // Prepare elements
        const streetIdField = $('#street_id_field');
        const houseTypeIdField = $('#house_type_id_field');
        const highRiseFields = $('#high_rise_fields');

        // Hide the elements first
        streetIdField.hide();
        houseTypeIdField.hide();
        toggleHighRiseFields(false);

        // Retrieve old value from laravel session
        const oldStreetId = "{{ old('street_id', '') }}";
        const oldHouseTypeId = "{{ old('house_type_id', '') }}";

        // Retrieve saved value from database if existed
        const savedStreetId = "{{ $manageHouse->street->id ?? '' }}";
        const savedHouseTypeId = "{{ $manageHouse->house_type->id ?? '' }}";

        // Check if areaId has value
        const areaId = "{{ $area->id ?? ''}}";

        // If areaId is not empty, then fetch data
        if(isNotEmptyString(areaId)) {
            getStreet(areaId);
            getHouseType(areaId);
        }

        // Fetch data on selection changed
        $('#area_id').on('change', function (e) {
            if (isNotEmptyString(this.value)) {
                getStreet(this.value);
                getHouseType(this.value);
            } else {
                streetIdField.hide();
                houseTypeIdField.hide();
                toggleHighRiseFields(false);
            }
        });

        // Show high rise field, if the house type is high rise building
        $('#house_type_id').on('change', function (e) {
            const option = $(this).find(':selected');
            const type = $(option).data('housetype-type');
            $('#house_type_type').val(type);

            toggleHighRiseFields(type === 'HIGH_RISE');
        });

        // False is hide, True is show
        function toggleHighRiseFields(show) {
            const highRiseFields = $('#high_rise_fields');
            if (show === true) {
                highRiseFields.show();
                const inputs = highRiseFields.find('input');
                for (const input of inputs) {
                    $(input).prop('disabled', false);
                }
            } else {
                highRiseFields.hide();
                const inputs = highRiseFields.find('input');
                for (const input of inputs) {
                    $(input).prop('disabled', true);
                }
            }
        }

        // Get house type by area id
        function getHouseType(area) {
            $.get(`{{ route('ajax.manage-house.getHouseType', '') }}/${area}`, 
                function (data, textStatus, jqXHR) {
                    const el = $('#house_type_id');
                    el.children('option').remove(); // Remove all options
                    for(const houseType of data) {
                        // Add options
                        var newOption = new Option(
                                houseType.name, 
                                houseType.id, 
                                false, 
                                (isNotEmptyString(oldHouseTypeId) 
                                ? houseType.id == oldHouseTypeId
                                : houseType.id == savedHouseTypeId)
                            );
                        newOption.setAttribute('data-housetype-type', houseType.type);
                        el.append(newOption).trigger('change');
                    }
                    houseTypeIdField.show();
                }
            ).fail(function (jqXHR, textStatus, error) {
                console.error(jqXHR);
                console.error(textStatus);
                console.error(error);
            });
        }

        // Get street by area id
        function getStreet(area) {
            $.get(`{{ route('ajax.manage-house.getStreet', '') }}/${area}`, 
                function (data, textStatus, jqXHR) {
                    const el = $('#street_id');
                    el.children('option').remove(); // Remove all options
                    for(const street of data) {
                        // Add options
                        var newOption = new Option(
                                street.street_name, 
                                street.id, 
                                false, 
                                (isNotEmptyString(oldStreetId)
                                ? street.id == oldStreetId
                                : street.id == savedStreetId)   
                            );
                        el.append(newOption).trigger('change');
                    }
                    streetIdField.show();
                }
            ).fail(function (jqXHR, textStatus, error) {
                console.error(jqXHR);
                console.error(textStatus);
                console.error(error);
            });
        }
    });
</script>