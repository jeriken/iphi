<template>
  <div>
    <badaso-breadcrumb-row>
      <template slot="action">
        <vs-button
          color="danger"
          type="relief"
          v-if="selected.length > 0 && $helper.isAllowed('delete_activitylogs')"
          @click.stop
          @click="confirmDeleteMultiple"
          ><vs-icon icon="delete_sweep"></vs-icon>
          {{ $t("action.bulkDelete") }}</vs-button
        >
      </template>
    </badaso-breadcrumb-row>
    <vs-row v-if="$helper.isAllowed('browse_activitylogs')">
      <vs-col vs-lg="12">
        <vs-card>
          <div slot="header">
            <h3>{{ $t("activityLog.title") }}</h3>
          </div>
          <div>
            <badaso-server-side-table
              v-model="selected"
              :data="activitylogs"
              stripe
              :pagination-data="data"
              @search="handleSearch"
              @changePage="handlePageChange"
              @changeLimit="handleLimitChange"
              @sort="handleSort"
              :description-items="descriptionItems"
              :description-title="$t('crudGenerated.footer.descriptionTitle')"
              :description-connector="
                $t('crudGenerated.footer.descriptionConnector')
              "
            >
              <template slot="thead">
                <badaso-th sort-key="logName">
                  {{ $t("activityLog.header.logName") }}
                </badaso-th>
                <badaso-th sort-key="causerName">
                  {{ $t("activityLog.header.causerName") }}
                </badaso-th>
                <badaso-th sort-key="description">
                  {{ $t("activityLog.header.description") }}
                </badaso-th>
                <badaso-th sort-key="createdAt">
                  {{ $t("activityLog.header.dateLogged") }}
                </badaso-th>
                <badaso-th> {{ $t("activityLog.header.action") }} </badaso-th>
              </template>

              <template slot="tbody">
                <vs-tr
                  :data="record"
                  :key="index"
                  v-for="(record, index) in activitylogs"
                >
                  <vs-td :data="record.logName">
                    {{ record.logName ? record.logName : "-" }}
                  </vs-td>
                  <vs-td :data="record.causerName">
                    {{ record.causerName ? record.causerName : "-" }}
                  </vs-td>
                  <vs-td :data="record.description">
                    {{ record.description }}
                  </vs-td>
                  <vs-td :data="record.createdAt">
                    {{ $helper.formatDate(record.createdAt) }}
                  </vs-td>
                  <vs-td style="" class="activity-log__dropdown-button">
                    <badaso-dropdown vs-trigger-click>
                      <vs-button
                        size="large"
                        type="flat"
                        icon="more_vert"
                      ></vs-button>
                      <vs-dropdown-menu>
                        <badaso-dropdown-item
                          :to="{
                            name: 'ActivityLogRead',
                            params: { id: record.id },
                          }"
                          icon="visibility"
                        >
                          Detail
                        </badaso-dropdown-item>
                      </vs-dropdown-menu>
                    </badaso-dropdown>
                  </vs-td>
                </vs-tr>
              </template>
            </badaso-server-side-table>
          </div>
        </vs-card>
      </vs-col>
    </vs-row>
    <vs-row v-else>
      <vs-col vs-lg="12">
        <vs-card>
          <vs-row>
            <vs-col vs-lg="12">
              <h3>{{ $t("activityLog.warning.notAllowed") }}</h3>
            </vs-col>
          </vs-row>
        </vs-card>
      </vs-col>
    </vs-row>
  </div>
</template>
<script>
// eslint-disable-next-line no-unused-vars
import moment from "moment";

export default {
  name: "ActivityLogBrowse",
  components: {},
  data: () => ({
    data: {},
    selected: [],
    descriptionItems: [10, 50, 100],
    activitylogs: [],
    willDeleteId: null,
    page: 1,
    limit: 10,
    totalItem: 0,
    filter: "",
    orderField: "",
    orderDirection: "",
  }),
  mounted() {
    this.getActivityLogList();
  },
  watch: {
    page: function (to, from) {
      this.getActivityLogList();
    },
    limit: function (to, from) {
      this.page = 1;
      this.getActivityLogList();
    },
  },
  methods: {
    handleSearch(e) {
      this.filter = e.target.value;
      this.page = 1;
      this.getActivityLogList();
    },
    handlePageChange(e) {
      this.page = e;
    },
    handleLimitChange(e) {
      this.limit = e;
    },
    handleSort(key, type) {
      this.orderField = key;
      this.orderDirection = type;
      this.getActivityLogList();
    },
    getActivityLogList() {
      this.$openLoader();
      this.$api.badasoActivityLog
        .browse({
          filter: this.filter,
          limit: this.limit,
          page: this.page,
          orderField: this.orderField,
          orderDirection: this.orderDirection,
        })
        .then((response) => {
          this.$closeLoader();
          this.selected = [];
          this.data = response.data;
          this.activitylogs = response.data.data;
          this.totalItem =
            response.data.total > 0
              ? Math.ceil(response.data.total / this.limit)
              : 1;
        })
        .catch((error) => {
          this.$closeLoader();
          this.$vs.notify({
            title: this.$t("alert.danger"),
            text: error.message,
            color: "danger",
          });
        });
    },
  },
};
</script>
