/**********************************************************************
 * XPLR v1.1
 * Nov 17, 2020
 * by Caleb Georgeson
 *
 * Simple JSON deserialization
 * Everything is placed inside a map.
 * v1.1 Added unicode parsing (\u**** and &#****;)
 * Current version has no error checking. If invalid JSON is input,
 * there may be problems.
 **********************************************************************/



package com.communitypioneer.android

import android.util.Log
import okio.Utf8
import kotlin.math.pow

private const val BEGIN_MAP_TOKEN = '{'
private const val END_MAP_TOKEN = '}'
private const val BEGIN_STRING_TOKEN = '"'
private const val END_STRING_TOKEN = '"'
private const val BEGIN_LIST_TOKEN = '['
private const val END_LIST_TOKEN = ']'
private const val ADD_ITEM_TOKEN = ','
private const val ADD_VALUE_TOKEN = ':'
private const val ESCAPE_TOKEN = '\\'
private const val BOOL_TRUE_TOKEN = 't'
private const val BOOL_FALSE_TOKEN = 'f'
private const val NULL_TOKEN = 'n'

class XPLR {
    private var json : String = ""
    private var index : Int = 0

    fun deserialize(json : String) : Any? {
        this.json = json
        this.index = 1

        var deserial : Any? = null

        when (json[0]) {
            BEGIN_LIST_TOKEN -> deserial = getList()
            BEGIN_MAP_TOKEN  -> deserial = getMap()
            else ->  println("Unexpected token ${json[0]} at index 0")
        }

        return deserial
    }

    private fun getMap() : MutableMap<String, Any?>{
        val map : MutableMap<String, Any?> = mutableMapOf()
        var key: String
        var value : Any? = null

        while (json[index] != END_MAP_TOKEN) {

            when {
                json[index] == BEGIN_STRING_TOKEN -> {
                    index++
                    // Get key
                    key = getString()

                    if (json[index++] == ADD_VALUE_TOKEN) {

                        // Get value
                        when (json[index++]) {
                            BEGIN_STRING_TOKEN -> value = getString()
                            BEGIN_MAP_TOKEN    -> value = getMap()
                            BEGIN_LIST_TOKEN   -> value = getList()
                            in '0' .. '9'      -> {
                                value = if (isInt()) {
                                    getInteger()
                                } else {
                                    getDouble()
                                }
                            }
                            BOOL_FALSE_TOKEN, BOOL_TRUE_TOKEN -> value = getBoolean()
                            NULL_TOKEN -> {
                                value = null
                                index += 3
                            }
                            ADD_ITEM_TOKEN     -> value = doNothing()
                            else -> {
                                println("Unexpected token ${json[index - 1]} at index ${index - 1}")
                            }
                        }

                    } else {
                        println("Unexpected token ${json[index - 1]} at index ${index - 1}")
                        index++
                    }

                    map[key] = value
                }
                json[index] == ADD_ITEM_TOKEN -> {
                    index++
                }
                else -> {
                    println("Unexpected token ${json[index]} at index $index")
                }
            }
        }

        index++
        return map
    }

    private fun getList() : MutableList<Any> {
        val list : MutableList<Any> = mutableListOf(Any()).toMutableList()

        while (json[index] != END_LIST_TOKEN) {
            when (json[index++]) {
                BEGIN_STRING_TOKEN -> list.add(getString())
                BEGIN_MAP_TOKEN -> list.add(getMap())
                BEGIN_LIST_TOKEN   -> list.add(getList())
                in '0' .. '9'      -> {
                    if (isInt()) {
                        list.add(getInteger())
                    } else {
                        list.add(getDouble())
                    }
                }
                BOOL_FALSE_TOKEN, BOOL_TRUE_TOKEN -> list.add(getBoolean())
                ADD_ITEM_TOKEN     -> doNothing()
                else -> println("Unexpected token ${json[index - 1]} at index ${index - 1}")
            }
        }

        index++

        return list
    }

    private fun getString() : String {
        var string = ""

        while (json[index] != END_STRING_TOKEN)
            when (json[index]) {
                ESCAPE_TOKEN -> {
                    when (json[index+1]) {
                        BEGIN_STRING_TOKEN -> {
                            // Escaped quotes. Add them in and continue.
                            string += "\""
                            index += 2
                        }
                        '/' -> {
                            string += '/'
                            index += 2
                        }
                        'u' -> {
                            // The following four characters represent a unicode character in hexadecimal
                            var unicode = ""
                            index += 2
                            // Find the unicode characters
                            while (unicode.length < 4) {
                                unicode += json[index++]
                            }

                            // Convert the unicode characters into the corresponding symbol in UTF-16
                            string += Integer.parseInt(unicode, 16).toChar()
                        }
                        'n' -> {
                            // Skip over the \n
                            index += 2
                        }
                        else -> {
                            string += "\\"
                            index++
                        }
                    }
                }
                '&' -> {
                    if (json[index + 1] == '#') {
                        // The following characters represent a unicode character in decimal
                        var unicode = ""
                        index += 2
                        // Keep going until the ; is found
                        while (json[index] != ';') {
                            unicode += json[index++]
                        }

                        // Convert the unicode into the corresponding symbol
                        string += Integer.parseInt(unicode).toChar()
                    } else {
                        string += json[index]
                    }
                    index++
                }
                else -> {
                    string += json[index++]
                }
            }

        index++

        return string
    }

    private fun getInteger() : Int {
        index--

        var num = 0
        while (json[index] in '0' .. '9') {
            num = ((num * 10) + charToNum(json[index])).toInt()
            index++
        }

        return num
    }

    private fun getDouble() : Double {
        index--
        var num = 0.0

        // Add digits until there are no more digits
        while (json[index] in '0' .. '9') {
            num = (num * 10) + charToNum(json[index])
            index++
        }

        // If the next char is a . then there are still digits
        if (json[index] == '.') {
            num = num as Double
            var decimalPlace = 1
            index++
            while (json[index] in '0' .. '9') {
                num += charToNum(json[index]) / (10.0.pow(decimalPlace++))
                index++
            }
        }

        return num
    }

    private fun isInt() : Boolean {
        var i = index

        while (json[i] in '0' .. '9') {
            i++
        }

        if (json[i] == ADD_ITEM_TOKEN) {
            return true
        }

        return false
    }

    private fun charToNum(char : Char) : Double {
        when (char) {
            '0' -> return 0.0
            '1' -> return 1.0
            '2' -> return 2.0
            '3' -> return 3.0
            '4' -> return 4.0
            '5' -> return 5.0
            '6' -> return 6.0
            '7' -> return 7.0
            '8' -> return 8.0
            '9' -> return 9.0
        }

        return 0.0
    }

    private fun getBoolean() : Boolean {
        index--
        var bool = true

        var string = ""

        while (json[index] != END_LIST_TOKEN && json[index] != END_MAP_TOKEN && json[index] != ADD_ITEM_TOKEN) {
            string += json[index++]
        }

        if (string == "true")
            bool = true
        else if (string == "false")
            bool = false

        return bool
    }

    private fun doNothing() {}
}
