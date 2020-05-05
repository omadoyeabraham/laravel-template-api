<?php

namespace Tests\GraphQL\Schema;


class ReadingListSchema
{
    /**
     * Mutation for creating a reading list
     *
     * @return string
     */
    public static function createReadingList() {
        $mutation = '
                mutation CreateReadingList($input: CreateReadingListInput!) {
                    CreateReadingList(input: $input) {
                        id
                        name
                        description
                        user {
                          first_name
                          last_name
                          email
                        }
                    }
                }
            ';

        return $mutation;
    }
}
