<?php

/*
 * Copyright (C) 2019 Leda Ferreira
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace cbr724;

/**
 * Changes date format from ddmmyyyy to yyyy-mm-dd.
 * @param string $date
 * @return string
 */
function fix_date($date)
{
    return preg_replace('#^(\d{2})(\d{2})(\d{4})#', '$3-$2-$1', $date);
}

/**
 * Changes date format from dd/mm/yyyy to yyyy-mm-dd.
 * @param string $date
 * @return string
 */
function fix_short_date($date)
{
    return preg_replace('#^(\d{2})(\d{2})#', date('Y') . '-$2-$1', $date);
}
