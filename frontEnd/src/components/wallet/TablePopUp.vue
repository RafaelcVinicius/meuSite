<template>
  <div class="q-pa-md w100">
    <q-table
      flat bordered
      :rows="wallet"
      hide-header
      hide-bottom
      :columns="columns"
      row-key="name"
    >
      <template v-slot:body="props">
        <q-tr :props="props">
          <q-td
          v-for="col in props.cols"
          :key="col.name"
          :props="props"
          >
          {{ col.value }}
        </q-td>
        <q-td auto-width>
          <q-btn size="sm" color="gray" round flat @click="props.expand = !props.expand" :icon="props.expand ? 'expand_less' : 'expand_more'" />
        </q-td>
      </q-tr>
        <q-tr v-show="props.expand" :props="props">
          <q-td colspan="100%">
            <div v-for="(item, key) in props.row.itens" :key="key">
              <div class="flex-jb flex-ac">
                <div class="flex-c" to="\dd">
                  <span>{{item.description}}</span>
                  <span >{{item.value}}</span>
                </div>
                <q-btn size="sm" color="gray" round flat icon="chevron_right"/>
              </div>
              <hr>
            </div>
          </q-td>
        </q-tr>
      </template>
    </q-table>
  </div>
  {{ filters }}
{{  wallet}}
</template>

<script>
const columns = [
  { name: 'percentage', required: true, align: 'left', field: 'percentage', sortable: true },
  { name: 'name', required: true, align: 'left', field: row => row.name, sortable: true},
  { name: 'amount', required: true, align: 'center', field: 'amount', sortable: true },
]

// const rows = [
//   {
//     percentage: 50,
//     name: 'Renda fixa',
//     amount: 5,
//   },
//   {
//     percentage: 20,
//     name: 'Ações',
//     amount: 456,
//   },
//   {
//     percentage: 30,
//     name: 'Moedas',
//     amount: 159,
//   },
// ]

export default {
  setup () {
    return {
      columns,
      // rows
    }
  },
  props:{
    wallet:Array,
  },
}
</script>
